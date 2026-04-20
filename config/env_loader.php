<?php
/**
 * DATAVANT Systems - Lightweight .env Loader
 *
 * Parses a .env file from the project root and loads each KEY=VALUE pair
 * into the environment via putenv(), so getenv() works throughout the app.
 *
 * .env format:
 *   - One variable per line: KEY=VALUE
 *   - Lines starting with # are comments (ignored).
 *   - Blank lines are ignored.
 *   - Values may be unquoted, single-quoted, or double-quoted.
 *   - Quoted values have surrounding quotes stripped.
 *
 * Invocation contract:
 *   This file ONLY declares loadEnv(). It does NOT auto-load at include time.
 *   Call loadEnv() explicitly from the bootstrap file. This prevents
 *   accidental env loading in contexts where the bootstrap is intentionally
 *   skipped (e.g. CLI utilities, test harnesses).
 *
 * Security:
 *   - This file lives under config/, which is blocked by .htaccess.
 *   - The .env file itself is blocked by the dotfile rule in .htaccess.
 *   - Never expose this file or .env to the web.
 *
 * Note: In Docker, environment variables are injected via docker-compose.yml.
 * If an env var is already set (e.g. by Docker), it will NOT be overwritten.
 */

/**
 * Load environment variables from a .env file.
 *
 * @param string $path  Absolute path to the .env file.
 * @return void
 */
function loadEnv($path) {
    // If the file doesn't exist or isn't readable, silently return.
    // This is expected in Docker environments where env vars come from compose.
    if (!file_exists($path) || !is_readable($path)) {
        return;
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    if ($lines === false) {
        return;
    }

    foreach ($lines as $line) {
        // Skip comments.
        $trimmed = ltrim($line);
        if ($trimmed === '' || $trimmed[0] === '#') {
            continue;
        }

        // Must contain an = sign.
        $eqPos = strpos($trimmed, '=');
        if ($eqPos === false) {
            continue;
        }

        $key   = trim(substr($trimmed, 0, $eqPos));
        $value = trim(substr($trimmed, $eqPos + 1));

        // Reject invalid keys.
        if ($key === '' || strpos($key, ' ') !== false) {
            continue;
        }

        // Strip surrounding quotes from value (single or double).
        if (strlen($value) >= 2) {
            $first = $value[0];
            $last  = $value[strlen($value) - 1];
            if (($first === '"' && $last === '"') || ($first === "'" && $last === "'")) {
                $value = substr($value, 1, -1);
            }
        }

        // Only set if not already defined — lets Docker/compose override .env.
        if (getenv($key) === false) {
            putenv("{$key}={$value}");
            $_ENV[$key] = $value;
        }
    }
}

// No auto-call. Bootstrap must invoke loadEnv() explicitly.
