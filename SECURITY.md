# DATAVANT Systems — Security & Credential Rotation

This document explains how to rotate secrets, harden the deployment, and respond to credential exposure incidents. All operational secrets live in `.env`, which is excluded from version control by `.gitignore`.

---

## 1. Incident context

A Gmail App Password was previously committed to the working tree inside `.env`. That credential is considered **COMPROMISED** and must be rotated immediately, even if the repository has not been pushed to a remote.

The committed value is no longer present in `.env` — it has been replaced with the placeholder `__ROTATE_ME__`. The application is wired to fail-closed when it detects this placeholder, so no email can be sent until the rotation is completed.

---

## 2. Required rotation — Gmail App Password

1. Sign in to the Google account used for SMTP (`SMTP_USER` in `.env`).
2. Open https://myaccount.google.com/apppasswords.
3. **Revoke** the old "DATAVANT Systems" entry (or whatever label was used). This immediately invalidates the leaked password.
4. Click **Create app password**, label it `DATAVANT Systems Web`, generate, and copy the 16-character value.
5. Open `.env` and replace:
   ```
   SMTP_PASS=__ROTATE_ME__
   ```
   with:
   ```
   SMTP_PASS=xxxx xxxx xxxx xxxx
   ```
   (paste the value exactly as generated; spaces are allowed and Gmail accepts them).
6. Set `CONTACT_TO_EMAIL` to the inbox that should receive form submissions.
7. Save the file. Do **not** commit.

### Verification
After rotation, submit a test message through `contacto.php`. A successful submission returns HTTP 200 and a `request_id`. A `503` response indicates the application still detects the placeholder or missing values.

---

## 3. IP-hash salt rotation (`LOG_IP_SALT`)

The audit log stores hashed IPs (`sha256(ip + salt)`) instead of raw addresses. Rotating `LOG_IP_SALT` breaks the linkage between historical log entries and new ones, and should be done on a schedule or after any suspected log exposure.

1. Generate a fresh 32-byte hex string:
   ```
   # Any of these works:
   openssl rand -hex 32
   php -r "echo bin2hex(random_bytes(32)), PHP_EOL;"
   node -e "console.log(require('crypto').randomBytes(32).toString('hex'))"
   ```
2. Replace the existing `LOG_IP_SALT=...` line in `.env`.
3. Restart PHP-FPM / Apache (or the Docker container) so PHP re-reads the environment.

---

## 4. CSRF pool

CSRF tokens are maintained as a rotating pool of up to 5 tokens per session, each valid for 60 minutes and single-use. The pool is stored in `$_SESSION['csrf_pool']` and rebuilt automatically. There is no standalone secret to rotate, but **sessions must be invalidated** if a session-fixation attack is suspected:

1. Delete all PHP session files on the server (e.g. `/var/lib/php/sessions/*`).
2. Restart PHP-FPM / Apache.
3. Every active user will be issued a fresh session on their next request.

---

## 5. HTTPS migration checklist

The stack defaults to `APP_URL_SCHEME=http` for safe local development. Before moving to production:

- [ ] Obtain a TLS certificate (Let's Encrypt via certbot, or commercial CA).
- [ ] Set `APP_URL_SCHEME=https` and `APP_ENV=production` in `.env`.
- [ ] Swap `.htaccess` for `.htaccess.production` (which enables HSTS and `upgrade-insecure-requests`). The current `.htaccess` keeps HSTS commented-out and dev-safe.
- [ ] Verify `cookie_secure` is now `true` at runtime (the session code reads `APP_URL_SCHEME`).
- [ ] Verify that `Strict-Transport-Security` is emitted (`curl -I https://your-domain`).
- [ ] Consider enabling `Content-Security-Policy-Report-Only` before hard-enforcing a stricter CSP.

---

## 6. Secret handling rules

- `.env`, `logs/*.log`, and `logs/rate_limit.json` are in `.gitignore` — never commit them.
- `.env` is also in `.dockerignore` — never bake into an image.
- Rotate `SMTP_PASS` if it ever appears in a log, screenshot, stack trace, or chat transcript.
- Rotate `LOG_IP_SALT` annually at minimum, and immediately after any `logs/` exposure.
- Never fall back to a hardcoded personal email or password anywhere in the codebase. The app must fail-closed when credentials are missing.

---

## 7. Reporting a vulnerability

Please email `lucio.s.isc@gmail.com` with the details and, if possible, a proof-of-concept. Do not disclose publicly until a fix is confirmed.
