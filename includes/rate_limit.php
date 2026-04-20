<?php
/**
 * DATAVANT Systems - IP-based sliding-window rate limiter.
 *
 * File-backed counter stored in logs/rate_limit.json. Each key is
 * sha256(ip + LOG_IP_SALT) and each value is an array of unix timestamps
 * within the active window. Atomic read-modify-write protected by flock.
 *
 * Defaults: 3 submissions per 600 s per IP. Cleanup drops entries older
 * than 3600 s on every call so the file size stays bounded.
 */

const RL_WINDOW_SECONDS = 600;
const RL_MAX_IN_WINDOW  = 3;
const RL_CLEANUP_AFTER  = 3600;

/**
 * @return string absolute path to the rate-limit file.
 */
function rate_limit_file_path() {
    return dirname(__DIR__) . '/logs/rate_limit.json';
}

/**
 * Return a hashed identifier for the caller, or 'unknown' if inputs are missing.
 *
 * @param string $ip
 * @return string
 */
function rate_limit_key($ip) {
    $salt = getenv('LOG_IP_SALT');
    if (!is_string($salt) || $salt === '' || !is_string($ip) || $ip === '') {
        return 'unknown';
    }
    return hash('sha256', $ip . '|' . $salt);
}

/**
 * Check and record a submission attempt from $ip.
 *
 * @param string $ip
 * @return array ['allowed' => bool, 'retry_after' => int (seconds)]
 */
function rate_limit_check($ip) {
    $path = rate_limit_file_path();
    $dir  = dirname($path);
    if (!is_dir($dir)) {
        @mkdir($dir, 0755, true);
    }

    $key = rate_limit_key($ip);
    $now = time();

    $fh = @fopen($path, 'c+');
    if ($fh === false) {
        // Fail-open: if we cannot write the rate-limit file, don't block the user,
        // but this is logged at a higher level by the caller via ip_hash only.
        return ['allowed' => true, 'retry_after' => 0];
    }

    try {
        if (!flock($fh, LOCK_EX)) {
            return ['allowed' => true, 'retry_after' => 0];
        }

        $raw  = stream_get_contents($fh);
        $data = [];
        if (is_string($raw) && $raw !== '') {
            $decoded = json_decode($raw, true);
            if (is_array($decoded)) {
                $data = $decoded;
            }
        }

        // Housekeeping: drop entries whose newest timestamp is older than RL_CLEANUP_AFTER.
        foreach ($data as $k => $timestamps) {
            if (!is_array($timestamps)) {
                unset($data[$k]);
                continue;
            }
            $newest = end($timestamps);
            if (!is_int($newest) || ($now - $newest) > RL_CLEANUP_AFTER) {
                unset($data[$k]);
            }
        }

        $history = isset($data[$key]) && is_array($data[$key]) ? $data[$key] : [];

        // Keep only timestamps within the active sliding window.
        $history = array_values(array_filter($history, function ($ts) use ($now) {
            return is_int($ts) && ($now - $ts) < RL_WINDOW_SECONDS;
        }));

        if (count($history) >= RL_MAX_IN_WINDOW) {
            $oldest      = $history[0];
            $retry_after = max(1, RL_WINDOW_SECONDS - ($now - $oldest));
            // Do NOT record this attempt — we are rejecting it.
            $data[$key] = $history;
            rewind($fh);
            ftruncate($fh, 0);
            fwrite($fh, json_encode($data, JSON_UNESCAPED_SLASHES));
            fflush($fh);
            return ['allowed' => false, 'retry_after' => $retry_after];
        }

        // Accept and record this attempt.
        $history[]  = $now;
        $data[$key] = $history;

        rewind($fh);
        ftruncate($fh, 0);
        fwrite($fh, json_encode($data, JSON_UNESCAPED_SLASHES));
        fflush($fh);

        return ['allowed' => true, 'retry_after' => 0];

    } finally {
        flock($fh, LOCK_UN);
        fclose($fh);
    }
}
