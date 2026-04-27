/* ============================================
   DATAVANT Systems — Ambient canvas background
   Subtle particle network used as page backdrop on /nosotros.php.

   Behavior contract:
     - Vanilla JS, no jQuery, CSP-safe (external file, no inline JS).
     - Reads --dv-accent from CSS vars so it follows light/dark theme.
     - Caps DPR at 2 to keep cost bounded on retina screens.
     - Pauses when the tab is hidden or the canvas is off-screen.
     - prefers-reduced-motion → renders one static frame, no animation.
   ============================================ */
(function () {
    'use strict';

    var canvas = document.getElementById('dv-bg-canvas');
    if (!canvas || typeof canvas.getContext !== 'function') { return; }

    var ctx = canvas.getContext('2d', { alpha: true });
    if (!ctx) { return; }

    var prefersReducedMotion = window.matchMedia &&
        window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    var DPR_CAP        = 2;
    var BASE_DENSITY   = 14000;   // 1 particle per ~14k css px²
    var MIN_PARTICLES  = 22;
    var MAX_PARTICLES  = 80;
    var LINK_DIST      = 130;     // px (css units)
    var DOT_RADIUS     = 1.4;
    var SPEED          = 0.18;    // base drift per frame at 60fps
    var DOT_ALPHA          = 0.75;
    var LINK_ALPHA_DARK    = 0.8;   // stronger lines on dark theme
    var LINK_ALPHA_LIGHT   = 0.28;  // existing value reads fine on white

    var dpr = Math.min(window.devicePixelRatio || 1, DPR_CAP);
    var width = 0, height = 0;
    var particles = [];
    var color = readAccent();
    var linkAlphaMax = currentLinkAlpha();

    function currentLinkAlpha() {
        return document.documentElement.getAttribute('data-theme') === 'light'
            ? LINK_ALPHA_LIGHT
            : LINK_ALPHA_DARK;
    }

    function readAccent() {
        try {
            var raw = getComputedStyle(document.documentElement)
                .getPropertyValue('--dv-accent').trim();
            if (raw) { return hexToRgb(raw); }
        } catch (e) { /* ignore — fallback below */ }
        return { r: 129, g: 240, b: 118 };
    }

    function hexToRgb(c) {
        c = c.replace('#', '');
        if (c.length === 3) {
            c = c[0] + c[0] + c[1] + c[1] + c[2] + c[2];
        }
        if (c.length !== 6) { return { r: 129, g: 240, b: 118 }; }
        var n = parseInt(c, 16);
        if (isNaN(n)) { return { r: 129, g: 240, b: 118 }; }
        return { r: (n >> 16) & 255, g: (n >> 8) & 255, b: n & 255 };
    }

    function resize() {
        var rect = canvas.getBoundingClientRect();
        width  = Math.max(1, Math.floor(rect.width));
        height = Math.max(1, Math.floor(rect.height));

        canvas.width  = Math.floor(width  * dpr);
        canvas.height = Math.floor(height * dpr);
        ctx.setTransform(dpr, 0, 0, dpr, 0, 0);

        seedParticles();
    }

    function seedParticles() {
        var area  = width * height;
        var count = Math.round(area / BASE_DENSITY);
        if (count < MIN_PARTICLES) { count = MIN_PARTICLES; }
        if (count > MAX_PARTICLES) { count = MAX_PARTICLES; }
        if (width < 600 && count > 32) { count = 32; }

        particles = new Array(count);
        for (var i = 0; i < count; i++) {
            var angle = Math.random() * Math.PI * 2;
            var speedJitter = 0.6 + Math.random() * 0.8;
            particles[i] = {
                x: Math.random() * width,
                y: Math.random() * height,
                vx: Math.cos(angle) * SPEED * speedJitter,
                vy: Math.sin(angle) * SPEED * speedJitter
            };
        }
    }

    function step() {
        ctx.clearRect(0, 0, width, height);

        var rgb = color.r + ',' + color.g + ',' + color.b;
        var i, j, p, q, dx, dy, dist, alpha;
        var n = particles.length;

        for (i = 0; i < n; i++) {
            p = particles[i];
            p.x += p.vx;
            p.y += p.vy;

            if (p.x < -10)          { p.x = width  + 10; }
            else if (p.x > width  + 10) { p.x = -10; }
            if (p.y < -10)          { p.y = height + 10; }
            else if (p.y > height + 10) { p.y = -10; }

            ctx.beginPath();
            ctx.arc(p.x, p.y, DOT_RADIUS, 0, Math.PI * 2);
            ctx.fillStyle = 'rgba(' + rgb + ',' + DOT_ALPHA + ')';
            ctx.fill();
        }

        ctx.lineWidth = 1;
        for (i = 0; i < n; i++) {
            p = particles[i];
            for (j = i + 1; j < n; j++) {
                q = particles[j];
                dx = p.x - q.x;
                dy = p.y - q.y;
                dist = Math.sqrt(dx * dx + dy * dy);
                if (dist < LINK_DIST) {
                    alpha = (1 - dist / LINK_DIST) * linkAlphaMax;
                    ctx.strokeStyle = 'rgba(' + rgb + ',' + alpha + ')';
                    ctx.beginPath();
                    ctx.moveTo(p.x, p.y);
                    ctx.lineTo(q.x, q.y);
                    ctx.stroke();
                }
            }
        }
    }

    var rafId = 0;
    var running = false;
    var visible = true;

    function loop() {
        rafId = 0;
        if (!running) { return; }
        step();
        rafId = window.requestAnimationFrame(loop);
    }

    function start() {
        if (running || prefersReducedMotion) { return; }
        running = true;
        loop();
    }

    function stop() {
        running = false;
        if (rafId) {
            window.cancelAnimationFrame(rafId);
            rafId = 0;
        }
    }

    var resizeRaf = 0;
    window.addEventListener('resize', function () {
        if (resizeRaf) { return; }
        resizeRaf = window.requestAnimationFrame(function () {
            resizeRaf = 0;
            dpr = Math.min(window.devicePixelRatio || 1, DPR_CAP);
            resize();
            if (prefersReducedMotion) { step(); }
        });
    });

    if (window.MutationObserver) {
        var themeObs = new MutationObserver(function () {
            color = readAccent();
            linkAlphaMax = currentLinkAlpha();
            if (prefersReducedMotion) { step(); }
        });
        themeObs.observe(document.documentElement, {
            attributes: true,
            attributeFilter: ['data-theme']
        });
    }

    document.addEventListener('visibilitychange', function () {
        if (document.hidden) { stop(); }
        else if (visible)    { start(); }
    });

    if ('IntersectionObserver' in window) {
        var visObs = new IntersectionObserver(function (entries) {
            for (var k = 0; k < entries.length; k++) {
                visible = entries[k].isIntersecting;
            }
            if (visible && !document.hidden) { start(); }
            else                             { stop(); }
        }, { threshold: 0 });
        visObs.observe(canvas);
    }

    resize();
    if (prefersReducedMotion) { step(); }
    else                      { start(); }
})();
