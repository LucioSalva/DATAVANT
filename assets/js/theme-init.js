/* ============================================
   DATAVANT Systems - Early theme detection
   Loaded BEFORE main.css to prevent FOUC when a visitor has a persisted
   'light' preference. Keeps the <head> free of inline <script> so CSP
   can drop 'unsafe-inline' from script-src.

   Responsibilities:
     1. Read persisted preference (localStorage) or OS preference.
     2. Apply data-theme="light" early if needed — before paint.
     3. Sync <meta name="theme-color"> to match the active theme so mobile
        browser chrome (Android URL bar, iOS status bar tint) follows.
   ============================================ */
(function () {
    var DARK_COLOR  = '#0A0A0A';
    var LIGHT_COLOR = '#FFFFFF';

    try {
        var stored = null;
        try { stored = localStorage.getItem('dv-theme'); } catch (e) { /* ignore */ }

        var theme = stored;
        if (!theme && window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches) {
            theme = 'light';
        }
        if (theme === 'light') {
            document.documentElement.setAttribute('data-theme', 'light');
        }

        // Sync <meta name="theme-color"> early. main.js will keep it in sync
        // on user-initiated toggles; here we handle the first paint.
        var isLight = (theme === 'light');
        var meta = document.querySelector('meta[name="theme-color"]');
        if (meta) {
            meta.setAttribute('content', isLight ? LIGHT_COLOR : DARK_COLOR);
        }
    } catch (e) { /* fail silent; dark theme is the default */ }
})();
