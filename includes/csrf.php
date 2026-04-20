<?php
/**
 * DATAVANT Systems - CSRF token pool.
 *
 * Multi-tab-safe CSRF defense. Each session holds a pool of up to
 * CSRF_POOL_MAX tokens; every token is valid for CSRF_TTL seconds and
 * single-use. Calling csrf_token() issues a NEW token and rotates out
 * the oldest / expired ones. Calling csrf_verify() consumes a matching
 * token and returns true; otherwise returns false.
 *
 * Requires: includes/session.php must have started the session.
 */

const CSRF_POOL_KEY = 'csrf_pool';
const CSRF_POOL_MAX = 5;
const CSRF_TTL      = 3600; // 60 minutes

/**
 * Internal: prune expired tokens from the pool.
 *
 * @return void
 */
function csrf_prune() {
    if (!isset($_SESSION[CSRF_POOL_KEY]) || !is_array($_SESSION[CSRF_POOL_KEY])) {
        $_SESSION[CSRF_POOL_KEY] = [];
        return;
    }
    $now = time();
    foreach ($_SESSION[CSRF_POOL_KEY] as $tok => $issuedAt) {
        if (!is_int($issuedAt) || ($now - $issuedAt) > CSRF_TTL) {
            unset($_SESSION[CSRF_POOL_KEY][$tok]);
        }
    }
}

/**
 * Issue a new CSRF token and return it. Cycles out the oldest entry
 * when the pool is full.
 *
 * @return string
 */
function csrf_token() {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        // Defensive: session must be started before we touch $_SESSION.
        return '';
    }

    csrf_prune();

    $token = bin2hex(random_bytes(32));
    $_SESSION[CSRF_POOL_KEY][$token] = time();

    // Cap pool size: drop the oldest entries until within CSRF_POOL_MAX.
    if (count($_SESSION[CSRF_POOL_KEY]) > CSRF_POOL_MAX) {
        asort($_SESSION[CSRF_POOL_KEY], SORT_NUMERIC);
        while (count($_SESSION[CSRF_POOL_KEY]) > CSRF_POOL_MAX) {
            array_shift($_SESSION[CSRF_POOL_KEY]);
        }
    }
    return $token;
}

/**
 * Verify a submitted CSRF token. On success the token is removed from
 * the pool (single-use). Constant-time comparison against every pool
 * entry keeps pool membership from being timed.
 *
 * @param string $submitted
 * @return bool
 */
function csrf_verify($submitted) {
    if (session_status() !== PHP_SESSION_ACTIVE) {
        return false;
    }
    if (!is_string($submitted) || $submitted === '') {
        return false;
    }

    csrf_prune();

    if (empty($_SESSION[CSRF_POOL_KEY]) || !is_array($_SESSION[CSRF_POOL_KEY])) {
        return false;
    }

    $match = null;
    foreach ($_SESSION[CSRF_POOL_KEY] as $tok => $_issuedAt) {
        if (hash_equals((string)$tok, $submitted)) {
            $match = $tok;
            // Do not break early — constant-time intent.
        }
    }

    if ($match !== null) {
        unset($_SESSION[CSRF_POOL_KEY][$match]);
        return true;
    }
    return false;
}
