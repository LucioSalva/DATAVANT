<?php
/**
 * DATAVANT Systems - Contact Form Handler
 *
 * Pipeline:
 *   1. Method check                → 405
 *   2. CSRF pool verify            → 403 submit_fail_csrf
 *   3. Honeypot                    → 403 submit_fail_honeypot (silent 200 to bot via fake-success path)
 *   4. Privacy consent             → 403 submit_fail_consent
 *   5. Time-trap (>2 s)            → 403 submit_fail_honeypot
 *   6. IP sliding-window rate      → 429 submit_fail_rate
 *   7. Input validation + sanitize → 400 submit_fail_validation
 *   8. Mail configuration check    → 503 submit_fail_config
 *   9. SMTP send                   → 502 submit_fail_smtp | 200 submit_success
 *  10. Unexpected                  → 500 submit_fail_internal
 *
 * Response shape (always JSON):
 *   { ok: bool, message: string, request_id: string, csrf_token: string }
 *
 * Logging:
 *   JSONL records in logs/events_YYYY-MM.log via includes/logger.php.
 *   Only: request_id, ts, event, ip_hash, error_code, http_code, elapsed_ms.
 *   NEVER: name, email, subject, message body, user agent, raw ip.
 */

require_once __DIR__ . '/includes/bootstrap.php';
require_once __DIR__ . '/includes/rate_limit.php';

// PHPMailer (manual include, no Composer).
require_once __DIR__ . '/vendor/phpmailer/Exception.php';
require_once __DIR__ . '/vendor/phpmailer/PHPMailer.php';
require_once __DIR__ . '/vendor/phpmailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;

header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');
header('Cache-Control: no-store');

$request_id = request_id_new();
$started_at = microtime(true);

$client_ip = isset($_SERVER['REMOTE_ADDR']) ? (string)$_SERVER['REMOTE_ADDR'] : '';
$ip_hash   = log_ip_hash($client_ip);

/**
 * Final response: emit JSON, log, and exit. Single exit point for the script.
 *
 * @param int    $http
 * @param bool   $ok
 * @param string $message    User-facing message (no debug codes, no PII).
 * @param string $event      One of LOGGER_ALLOWED_EVENTS.
 * @param string $error_code Internal taxonomy (never surfaced to client).
 * @param array  $headers    Optional extra response headers.
 */
function dv_respond($http, $ok, $message, $event, $error_code = '', array $headers = []) {
    global $request_id, $started_at, $ip_hash;

    foreach ($headers as $h) {
        header($h);
    }

    http_response_code($http);

    // Every response hands the client a fresh CSRF token so the form stays usable.
    $next_token = csrf_token();

    $payload = [
        'ok'         => (bool)$ok,
        'message'    => (string)$message,
        'request_id' => $request_id,
        'csrf_token' => $next_token,
    ];

    log_event($event, $request_id, [
        'ip_hash'    => $ip_hash,
        'error_code' => $error_code,
        'http_code'  => $http,
        'status'     => $ok ? 'ok' : 'fail',
        'elapsed_ms' => (int) round((microtime(true) - $started_at) * 1000),
    ]);

    echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

// =============================================================
// 1. Method check
// =============================================================
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    dv_respond(
        405,
        false,
        'Método no permitido.',
        'submit_fail_method',
        'METHOD_NOT_ALLOWED'
    );
}

// =============================================================
// 2. CSRF pool verification
// =============================================================
$submitted_csrf = isset($_POST['csrf_token']) ? (string)$_POST['csrf_token'] : '';
if (!csrf_verify($submitted_csrf)) {
    dv_respond(
        403,
        false,
        'Tu sesión expiró por seguridad. Recarga la página e intenta de nuevo.',
        'submit_fail_csrf',
        'CSRF_INVALID'
    );
}

// =============================================================
// 3. Honeypot (legitimate users never populate this field)
// =============================================================
$honeypot = isset($_POST['website']) ? trim((string)$_POST['website']) : '';
if ($honeypot !== '') {
    // Return a plausible 200 success to the bot while logging the trigger.
    dv_respond(
        200,
        true,
        'Mensaje enviado correctamente. Te responderé a la brevedad.',
        'submit_fail_honeypot',
        'HONEYPOT_TRIGGERED'
    );
}

// =============================================================
// 4. Privacy consent
// =============================================================
$consent = isset($_POST['privacy_consent']) ? (string)$_POST['privacy_consent'] : '';
if ($consent !== '1' && $consent !== 'on' && $consent !== 'true') {
    dv_respond(
        403,
        false,
        'Debes aceptar el aviso de privacidad para enviar el mensaje.',
        'submit_fail_consent',
        'CONSENT_MISSING'
    );
}

// =============================================================
// 5. Time trap (form must take >2 s of human interaction)
// =============================================================
$form_ts = isset($_POST['form_ts']) ? (int)$_POST['form_ts'] : 0;
if ($form_ts > 0) {
    $elapsed = time() - $form_ts;
    if ($elapsed < 2) {
        dv_respond(
            403,
            false,
            'Envío demasiado rápido. Intenta de nuevo.',
            'submit_fail_honeypot',
            'TIME_TRAP'
        );
    }
}

// =============================================================
// 6. IP sliding-window rate limit
// =============================================================
$rate = rate_limit_check($client_ip);
if (!$rate['allowed']) {
    dv_respond(
        429,
        false,
        'Has enviado varios mensajes recientemente. Intenta nuevamente en unos minutos.',
        'submit_fail_rate',
        'RATE_LIMIT',
        ['Retry-After: ' . (int)$rate['retry_after']]
    );
}

// =============================================================
// 7. Validation + sanitize
// =============================================================
$nombre   = isset($_POST['nombre'])   ? trim((string)$_POST['nombre'])   : '';
$email    = isset($_POST['email'])    ? trim((string)$_POST['email'])    : '';
$telefono = isset($_POST['telefono']) ? trim((string)$_POST['telefono']) : '';
$asunto   = isset($_POST['asunto'])   ? trim((string)$_POST['asunto'])   : '';
$mensaje  = isset($_POST['mensaje'])  ? trim((string)$_POST['mensaje'])  : '';

$nombre   = strip_tags($nombre);
$email    = strip_tags($email);
$telefono = strip_tags($telefono);
$asunto   = strip_tags($asunto);
$mensaje  = strip_tags($mensaje);

// Header-injection defense (CR/LF must never reach mail headers).
$nombre = preg_replace('/[\r\n]+/', ' ', $nombre);
$email  = preg_replace('/[\r\n]+/', '', $email);
$asunto = preg_replace('/[\r\n]+/', ' ', $asunto);

$errors = [];
if ($nombre === '') {
    $errors[] = 'El nombre es obligatorio.';
} elseif (mb_strlen($nombre) < 2 || mb_strlen($nombre) > 100) {
    $errors[] = 'El nombre debe tener entre 2 y 100 caracteres.';
}
if ($email === '') {
    $errors[] = 'El correo es obligatorio.';
} elseif (mb_strlen($email) > 150 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Ingresa un correo válido.';
}
if ($telefono !== '') {
    $tel_digits = preg_replace('/[\s\-\(\)\+]/', '', $telefono);
    if (!preg_match('/^\d{7,15}$/', (string)$tel_digits) || mb_strlen($telefono) > 20) {
        $errors[] = 'El teléfono debe contener entre 7 y 15 dígitos.';
    }
}
if ($asunto === '') {
    $errors[] = 'El asunto es obligatorio.';
} elseif (mb_strlen($asunto) < 3 || mb_strlen($asunto) > 200) {
    $errors[] = 'El asunto debe tener entre 3 y 200 caracteres.';
}
if ($mensaje === '') {
    $errors[] = 'El mensaje es obligatorio.';
} elseif (mb_strlen($mensaje) < 10 || mb_strlen($mensaje) > 2000) {
    $errors[] = 'El mensaje debe tener entre 10 y 2000 caracteres.';
}

if (preg_match('/(Content-Type:|Bcc:|Cc:|To:)/i', $email)) {
    dv_respond(
        400,
        false,
        'Datos inválidos detectados en el formulario.',
        'submit_fail_validation',
        'HEADER_INJECTION'
    );
}

if (!empty($errors)) {
    dv_respond(
        400,
        false,
        implode(' ', $errors),
        'submit_fail_validation',
        'VALIDATION_FAILED'
    );
}

// =============================================================
// 8. Mail configuration check (fail-closed)
// =============================================================
require_once __DIR__ . '/config/mail.php';
if (!mail_is_configured()) {
    dv_respond(
        503,
        false,
        'El servicio de correo no está disponible en este momento. Intenta más tarde o escríbenos directamente.',
        'submit_fail_config',
        'MAIL_NOT_CONFIGURED'
    );
}
$mailConfig = mail_config();

// =============================================================
// 9. SMTP send
// =============================================================
$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = $mailConfig['smtp_host'];
    $mail->SMTPAuth   = true;
    $mail->Username   = $mailConfig['smtp_user'];
    $mail->Password   = $mailConfig['smtp_pass'];

    $smtpSecure = strtolower((string)$mailConfig['smtp_secure']);
    $mail->SMTPSecure = ($smtpSecure === 'ssl')
        ? PHPMailer::ENCRYPTION_SMTPS
        : PHPMailer::ENCRYPTION_STARTTLS;

    $mail->Port     = $mailConfig['smtp_port'];
    $mail->CharSet  = 'UTF-8';
    $mail->Encoding = 'base64';
    $mail->Timeout  = 10;

    // Gmail requires From to match the authenticated user. Reply-To carries the visitor.
    $fromEmail = $mailConfig['smtp_from_email'] !== '' ? $mailConfig['smtp_from_email'] : $mailConfig['smtp_user'];
    $mail->setFrom($fromEmail, $mailConfig['smtp_from_name']);
    $mail->addAddress($mailConfig['contact_to']);
    $mail->addReplyTo($email, $nombre);

    $mail->isHTML(false);
    $mail->Subject = '[DATAVANT Web] ' . $asunto;

    $body  = "Nuevo mensaje desde el formulario de contacto de DATAVANT Systems\n";
    $body .= "================================================================\n\n";
    $body .= "Nombre:    {$nombre}\n";
    $body .= "Email:     {$email}\n";
    if ($telefono !== '') {
        $body .= "Teléfono:  {$telefono}\n";
    }
    $body .= "Asunto:    {$asunto}\n\n";
    $body .= "Mensaje:\n";
    $body .= "----------------------------------------------------------------\n";
    $body .= $mensaje . "\n";
    $body .= "----------------------------------------------------------------\n\n";
    $body .= "--- Metadatos ---\n";
    $body .= 'Fecha/Hora:  ' . gmdate('Y-m-d H:i:s') . " UTC\n";
    $body .= 'Request ID:  ' . $request_id . "\n";

    $mail->Body = $body;
    $mail->send();

    dv_respond(
        200,
        true,
        'Mensaje enviado correctamente. Te responderé a la brevedad.',
        'submit_success',
        'OK'
    );

} catch (PHPMailerException $e) {
    // Classify without ever echoing PHPMailer ErrorInfo to the client.
    $raw = isset($mail->ErrorInfo) ? (string)$mail->ErrorInfo : (string)$e->getMessage();
    $low = strtolower($raw);
    $errCode = 'SMTP_SEND_FAILED';
    if (strpos($low, '535') !== false || strpos($low, 'authenticate') !== false) {
        $errCode = 'SMTP_AUTH_FAILED';
    } elseif (strpos($low, 'timed out') !== false || strpos($low, 'timeout') !== false) {
        $errCode = 'SMTP_TIMEOUT';
    } elseif (strpos($low, 'connect') !== false || strpos($low, 'getaddrinfo') !== false) {
        $errCode = 'SMTP_CONNECT_FAILED';
    }
    dv_respond(
        502,
        false,
        'No se pudo entregar el mensaje en este momento. Intenta más tarde.',
        'submit_fail_smtp',
        $errCode
    );

} catch (\Throwable $e) {
    dv_respond(
        500,
        false,
        'Ocurrió un error inesperado. Intenta más tarde.',
        'submit_fail_internal',
        'INTERNAL_ERROR'
    );
}
