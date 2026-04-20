<?php
/**
 * DATAVANT Systems - Centralized session bootstrap.
 *
 * Single point of session configuration. Every page that needs a session
 * must include this file (via includes/bootstrap.php). Individual pages
 * MUST NOT call session_start() directly — inconsistent cookie flags are
 * a well-known session-fixation vector.
 *
 * Cookie flags are driven by APP_URL_SCHEME so the same code runs safely
 * over plain HTTP during local development and over HTTPS in production.
 */

if (session_status() === PHP_SESSION_NONE) {
    $scheme   = getenv('APP_URL_SCHEME') ?: 'http';
    $isHttps  = ($scheme === 'https');

    session_name('DV_SESS');

    session_start([
        'cookie_httponly' => true,
        'cookie_secure'   => $isHttps,
        'cookie_samesite' => 'Lax',
        'use_strict_mode' => true,
        'use_only_cookies'=> true,
    ]);
}
