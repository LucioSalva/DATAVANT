<?php
/**
 * DATAVANT Systems - Structured event logger.
 *
 * Emits one JSONL line per event into logs/events_YYYY-MM.log.
 * STRICT allowlist: only request_id, timestamp, event, ip_hash,
 * error_code, elapsed_ms, and status are ever written. Name, email,
 * subject, message body, User-Agent, and raw IP addresses are silently
 * dropped if a caller passes them in.
 *
 * Event taxonomy (enforced):
 *   submit_success
 *   submit_fail_validation
 *   submit_fail_csrf
 *   submit_fail_rate
 *   submit_fail_smtp
 *   submit_fail_honeypot
 *   submit_fail_consent
 *   submit_fail_method
 *   submit_fail_config
 *   submit_fail_internal
 */

const LOGGER_ALLOWED_EVENTS = [
    'submit_success',
    'submit_fail_validation',
    'submit_fail_csrf',
    'submit_fail_rate',
    'submit_fail_smtp',
    'submit_fail_honeypot',
    'submit_fail_consent',
    'submit_fail_method',
    'submit_fail_config',
    'submit_fail_internal',
];

const LOGGER_ALLOWED_CONTEXT_KEYS = [
    'error_code',
    'ip_hash',
    'elapsed_ms',
    'status',
    'http_code',
];

/**
 * Hash a client IP into a non-identifying token using LOG_IP_SALT.
 *
 * @param string $ip
 * @return string 16-char prefix of sha256 hex digest, or 'unknown' if inputs are missing.
 */
function log_ip_hash($ip) {
    $salt = getenv('LOG_IP_SALT');
    if (!is_string($salt) || $salt === '' || !is_string($ip) || $ip === '') {
        return 'unknown';
    }
    return substr(hash('sha256', $ip . '|' . $salt), 0, 16);
}

/**
 * Record a structured event.
 *
 * @param string $event       One of LOGGER_ALLOWED_EVENTS.
 * @param string $request_id  UUIDv4 from request_id_new().
 * @param array  $context     Optional subset of LOGGER_ALLOWED_CONTEXT_KEYS.
 * @return void
 */
function log_event($event, $request_id, array $context = []) {
    if (!in_array($event, LOGGER_ALLOWED_EVENTS, true)) {
        // Refuse unknown events rather than silently corrupt the log taxonomy.
        $event = 'submit_fail_internal';
    }

    $safe = [];
    foreach ($context as $k => $v) {
        if (!in_array($k, LOGGER_ALLOWED_CONTEXT_KEYS, true)) {
            continue; // drop PII / unknown keys
        }
        if (is_scalar($v) || $v === null) {
            $safe[$k] = $v;
        }
    }

    $record = [
        'ts'         => gmdate('c'),
        'event'      => $event,
        'request_id' => is_string($request_id) ? $request_id : '',
    ];
    foreach ($safe as $k => $v) {
        $record[$k] = $v;
    }

    $logDir  = dirname(__DIR__) . '/logs';
    $logFile = $logDir . '/events_' . gmdate('Y-m') . '.log';

    if (!is_dir($logDir)) {
        @mkdir($logDir, 0755, true);
    }

    $line = json_encode($record, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    if ($line === false) {
        return;
    }
    @file_put_contents($logFile, $line . "\n", FILE_APPEND | LOCK_EX);
}
