<?php
/**
 * DATAVANT Systems - Application bootstrap.
 *
 * Single entry point for every page and endpoint. Responsible for:
 *   1. Loading environment variables from .env (no-op in Docker).
 *   2. Starting the session with env-driven cookie flags.
 *   3. Loading the CSRF pool helpers.
 *   4. Loading the request-id + logger helpers.
 *
 * Pages and endpoints must call:
 *   require_once __DIR__ . '/includes/bootstrap.php';
 * before any other application logic.
 */

require_once __DIR__ . '/../config/env_loader.php';
loadEnv(dirname(__DIR__) . '/.env');

require_once __DIR__ . '/session.php';
require_once __DIR__ . '/csrf.php';
require_once __DIR__ . '/request_id.php';
require_once __DIR__ . '/logger.php';
