/* ============================================
   DATAVANT Systems - Early theme detection
   Loaded BEFORE main.css to prevent FOUC.
   Keeps the <head> free of inline <script> so CSP can drop 'unsafe-inline'
   from script-src.

   POLICY (dark mode is the brand default):
     1. If localStorage 'dv-theme' is set → honor it (user already chose).
     2. Otherwise → force dark. We DO NOT fall back to prefers-color-scheme:
        the brand identity is dark-first, regardless of OS preference.
     3. Set data-theme synchronously on <html> BEFORE first paint to
        prevent FOUC on mobile and on slow devices.
     4. Sync <meta name="theme-color"> so mobile browser chrome (Android URL
        bar, iOS status bar tint) matches the active theme on first paint.
   ============================================ */
(function () {
    var DARK_COLOR  = '#0A0A0A';
    var LIGHT_COLOR = '#FFFFFF';

    try {
        var stored = null;
        try { stored = localStorage.getItem('dv-theme'); } catch (e) { /* private mode / disabled storage */ }

        // Default is dark. Only honor a previously saved 'light' choice.
        // No prefers-color-scheme fallback — dark is the brand baseline.
        var isLight = (stored === 'light');

        if (isLight) {
            document.documentElement.setAttribute('data-theme', 'light');
        } else {
            // Be explicit and idempotent: ensure no stray attribute survives.
            document.documentElement.removeAttribute('data-theme');
        }

        var meta = document.querySelector('meta[name="theme-color"]');
        if (meta) {
            meta.setAttribute('content', isLight ? LIGHT_COLOR : DARK_COLOR);
        }
    } catch (e) { /* fail silent; dark theme is the default and CSS already paints it */ }
})();
