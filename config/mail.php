<?php
/**
 * DATAVANT Systems - Mail Configuration
 *
 * SMTP settings loaded exclusively from environment variables.
 * There is NO Gmail fallback and NO hardcoded personal address.
 * If the environment is not fully configured, mail_is_configured()
 * returns false and every caller must fail-closed.
 *
 * Bootstrap responsibility:
 *   config/env_loader.php is loaded via includes/bootstrap.php.
 *   Callers of this file must either require bootstrap.php first or
 *   ensure loadEnv() has already been called.
 *
 * SMTP Setup (Gmail):
 *   1. Copy .env.example to .env.
 *   2. Set SMTP_USER to your Gmail address.
 *   3. Set SMTP_PASS to a Google App Password (NOT your regular password).
 *      See SECURITY.md for the exact rotation procedure.
 *   4. Set CONTACT_TO_EMAIL to the destination inbox.
 */

/**
 * Build the immutable mail configuration array from environment variables.
 *
 * @return array
 */
function mail_config() {
    static $cfg = null;
    if ($cfg !== null) {
        return $cfg;
    }

    $cfg = [
        'smtp_host'       => getenv('SMTP_HOST')       ?: 'smtp.gmail.com',
        'smtp_port'       => (int)(getenv('SMTP_PORT') ?: 587),
        'smtp_user'       => getenv('SMTP_USER')       ?: '',
        'smtp_pass'       => getenv('SMTP_PASS')       ?: '',
        'smtp_secure'     => getenv('SMTP_SECURE')     ?: 'tls',
        'smtp_from_email' => getenv('SMTP_FROM_EMAIL') ?: '',
        'smtp_from_name'  => getenv('SMTP_FROM_NAME')  ?: 'DATAVANT Systems',
        'contact_to'      => getenv('CONTACT_TO_EMAIL') ?: '',
    ];
    return $cfg;
}

/**
 * Return true only when SMTP is fully configured and safe to use.
 *
 * Fail-closed policy:
 *   - SMTP_USER must be a non-empty valid email.
 *   - SMTP_PASS must be non-empty AND must not match any placeholder pattern
 *     (literal `__ROTATE_ME__`, leading `__`, or trailing `__` — the standard
 *     sentinels used by this project for "not yet configured" secrets).
 *   - CONTACT_TO_EMAIL must be a non-empty valid email.
 *
 * This guard is the single point that prevents the contact form from
 * silently accepting or losing messages when secrets have not been rotated.
 *
 * @return bool
 */
function mail_is_configured() {
    $c = mail_config();

    // 1) SMTP user: non-empty and a syntactically valid email.
    if ($c['smtp_user'] === '' || !filter_var($c['smtp_user'], FILTER_VALIDATE_EMAIL)) {
        return false;
    }

    // 2) SMTP password: non-empty and not a placeholder sentinel.
    $pass = (string)$c['smtp_pass'];
    if ($pass === '') {
        return false;
    }
    // Reject any value that looks like a template placeholder:
    //   __ROTATE_ME__, __CHANGE_ME__, __TODO__, etc.
    if (strpos($pass, '__') === 0 || substr($pass, -2) === '__') {
        return false;
    }

    // 3) Recipient: non-empty and a syntactically valid email.
    if ($c['contact_to'] === '' || !filter_var($c['contact_to'], FILTER_VALIDATE_EMAIL)) {
        return false;
    }

    return true;
}

/**
 * Best-effort fallback recipient to render in the "form unavailable" banner.
 * Never exposes SMTP credentials — only the public-facing sender identity.
 *
 * @return string  Email address or '' if nothing safe to show.
 */
function mail_fallback_contact_email() {
    $c = mail_config();
    $candidates = [$c['smtp_from_email'], $c['smtp_user']];
    foreach ($candidates as $email) {
        if (is_string($email) && $email !== '' && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return $email;
        }
    }
    return '';
}

// For backwards compatibility with callers that expected an array return.
return mail_config();
