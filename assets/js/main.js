/* ============================================
   DATAVANT Systems - Main JavaScript
   Dependencies: jQuery 3.7.1, Bootstrap 3.4.1
   ============================================ */

$(document).ready(function () {

    /* -----------------------------------------
       1. Navbar scroll effect
       ----------------------------------------- */
    var $navbar = $('.dv-navbar');

    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 50) {
            $navbar.addClass('navbar-scrolled');
        } else {
            $navbar.removeClass('navbar-scrolled');
        }
    });
    $(window).trigger('scroll');


    /* -----------------------------------------
       2. Smooth scroll for anchor links
       ----------------------------------------- */
    var prefersReducedMotion = window.matchMedia &&
        window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    $(document).on('click', 'a[href^="#"]', function (e) {
        var hash = this.getAttribute('href');
        if (!hash || hash === '#') { return; }
        var target = $(hash);
        if (target.length) {
            e.preventDefault();
            if (prefersReducedMotion) {
                window.scrollTo(0, target.offset().top - 70);
            } else {
                $('html, body').animate({
                    scrollTop: target.offset().top - 70
                }, 500);
            }
        }
    });


    /* -----------------------------------------
       3. Scroll animations (IntersectionObserver)
       ----------------------------------------- */
    var animSelectors = '.dv-animate, .dv-animate-left, .dv-animate-right, .dv-animate-scale';

    if ('IntersectionObserver' in window) {
        var animObserver = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animated');
                    animObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });

        $(animSelectors).each(function () {
            animObserver.observe(this);
        });
    } else {
        $(animSelectors).addClass('animated');
    }


    /* -----------------------------------------
       4. Mobile nav close on link click
       ----------------------------------------- */
    $('#dv-main-nav').on('click', 'li a', function () {
        var $collapse = $('#dv-main-nav');
        if ($collapse.hasClass('in')) {
            $collapse.collapse('hide');
        }
    });


    /* -----------------------------------------
       5. Contact form - validation + AJAX submit
       ----------------------------------------- */
    var $contactForm = $('#dv-contact-form');

    if ($contactForm.length) {

        var $submitBtn = $('#dv-submit-btn');
        var $alertBox  = $('#dv-form-alert');
        var submitText = $submitBtn.text();

        /**
         * Build an <li> from a safe text string. Server content is ALWAYS
         * rendered via textContent, never innerHTML.
         */
        function buildErrorItem(text) {
            var li = document.createElement('li');
            li.textContent = text;
            return li;
        }

        /**
         * Build a discrete request-id badge (for error traceability).
         */
        function buildRequestIdBadge(requestId) {
            if (!requestId) { return null; }
            var span = document.createElement('span');
            span.className = 'dv-request-id';
            // Show the first 8 chars to keep the UI compact.
            span.textContent = ' [ID: ' + String(requestId).slice(0, 8) + ']';
            return span;
        }

        /**
         * Build the alert DOM node from a plain text message plus an optional
         * list of validation bullets. No HTML string concatenation for any
         * server-controlled content.
         *
         * @param {'success'|'danger'} type
         * @param {string}   headline  plain text
         * @param {string}   message   plain text (may be empty)
         * @param {string[]} bullets   plain text list (may be empty)
         * @param {string}   requestId optional
         * @param {Node}     extraNode optional trailing node (e.g. mailto link)
         */
        function renderAlert(type, headline, message, bullets, requestId, extraNode) {
            var $el = $('<div/>', {
                'class': 'alert alert-' + type + ' dv-form-alert-item',
                'role':  'alert'
            });

            if (headline) {
                var strong = document.createElement('strong');
                strong.textContent = headline;
                $el.append(strong);
                $el.append(document.createTextNode(' '));
            }
            if (message) {
                $el.append(document.createTextNode(message));
            }
            if (bullets && bullets.length) {
                var ul = document.createElement('ul');
                ul.className = 'dv-form-alert-list';
                for (var i = 0; i < bullets.length; i++) {
                    ul.appendChild(buildErrorItem(bullets[i]));
                }
                $el.append(ul);
            }
            if (extraNode) {
                $el.append(document.createTextNode(' '));
                $el.append(extraNode);
            }
            if (requestId) {
                var badge = buildRequestIdBadge(requestId);
                if (badge) { $el.append(badge); }
            }

            $alertBox.empty().append($el);

            $('html, body').animate({
                scrollTop: $contactForm.offset().top - 90
            }, 400);
        }

        function buildMailtoLink(text) {
            var a = document.createElement('a');
            a.href = 'mailto:lucio.s.isc@gmail.com';
            a.textContent = text || 'lucio.s.isc@gmail.com';
            return a;
        }

        function setLoading(loading) {
            if (loading) {
                $submitBtn.prop('disabled', true);
                $submitBtn.empty();
                var spinner = document.createElement('span');
                spinner.className = 'dv-spinner';
                $submitBtn.append(spinner);
                $submitBtn.append(document.createTextNode(' Enviando...'));
            } else {
                $submitBtn.prop('disabled', false).text(submitText);
            }
        }

        $contactForm.on('submit', function (e) {
            e.preventDefault();

            // Fail-closed guard: when PHP marks the form as disabled (mail not
            // configured) we never send a request. The server would reject with
            // 503 anyway, but this keeps network noise down and the UX honest.
            if ($contactForm.attr('data-dv-disabled') === '1') {
                return false;
            }

            $alertBox.empty();

            var nombre   = $.trim($contactForm.find('[name="nombre"]').val());
            var email    = $.trim($contactForm.find('[name="email"]').val());
            var asunto   = $.trim($contactForm.find('[name="asunto"]').val());
            var mensaje  = $.trim($contactForm.find('[name="mensaje"]').val());
            var consent  = $contactForm.find('[name="privacy_consent"]').is(':checked');
            var errors   = [];

            if (!nombre) {
                errors.push('El nombre es obligatorio.');
            } else if (nombre.length < 2 || nombre.length > 100) {
                errors.push('El nombre debe tener entre 2 y 100 caracteres.');
            }
            if (!email) {
                errors.push('El correo es obligatorio.');
            } else if (email.length > 150 || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                errors.push('Ingresa un correo válido.');
            }
            if (!asunto) {
                errors.push('El asunto es obligatorio.');
            } else if (asunto.length < 3 || asunto.length > 200) {
                errors.push('El asunto debe tener entre 3 y 200 caracteres.');
            }
            if (!mensaje) {
                errors.push('El mensaje es obligatorio.');
            } else if (mensaje.length < 10 || mensaje.length > 2000) {
                errors.push('El mensaje debe tener entre 10 y 2000 caracteres.');
            }
            if (!consent) {
                errors.push('Debes aceptar el aviso de privacidad.');
            }

            if (errors.length > 0) {
                renderAlert('danger', 'Por favor corrige lo siguiente:', '', errors, null, null);
                return;
            }

            setLoading(true);

            var formData = new FormData($contactForm[0]);

            fetch('send_mail.php', {
                method: 'POST',
                body: formData,
                credentials: 'same-origin',
                headers: { 'Accept': 'application/json' }
            })
            .then(function (response) {
                return response.json().then(function (data) {
                    return { httpOk: response.ok, status: response.status, data: data };
                }).catch(function () {
                    return { httpOk: false, status: response.status, data: {} };
                });
            })
            .then(function (result) {
                setLoading(false);
                var data = result.data || {};

                if (data.csrf_token) {
                    $contactForm.find('[name="csrf_token"]').val(data.csrf_token);
                }

                if (data.ok === true) {
                    renderAlert(
                        'success',
                        'Mensaje enviado.',
                        data.message || 'Te responderé a la brevedad.',
                        [],
                        data.request_id || '',
                        null
                    );
                    $contactForm.find('input[type="text"], input[type="email"], input[type="tel"]').val('');
                    $contactForm.find('textarea').val('');
                    $contactForm.find('[name="privacy_consent"]').prop('checked', false);

                    setTimeout(function () {
                        $alertBox.find('.alert-success').fadeOut(400, function () {
                            $(this).remove();
                        });
                    }, 8000);
                    return;
                }

                // Error branch — message is already user-safe (server strips debug codes).
                var headline = 'No se pudo enviar el mensaje.';
                var msg      = data.message || 'Intenta de nuevo en unos minutos.';
                var extra    = null;

                // For 5xx or 429 we append a mailto as an escape hatch.
                if (result.status >= 500 || result.status === 429) {
                    extra = buildMailtoLink('Escríbeme directamente.');
                }

                renderAlert('danger', headline, msg, [], data.request_id || '', extra);
            })
            .catch(function () {
                setLoading(false);
                renderAlert(
                    'danger',
                    'Error de conexión.',
                    'No se pudo enviar el mensaje. Verifica tu conexión o ',
                    [],
                    '',
                    buildMailtoLink('escríbeme directamente.')
                );
            });
        });

        // Clear error alerts on input focus
        $contactForm.on('focus', '.form-control', function () {
            $alertBox.find('.alert-danger').fadeOut(300, function () {
                $(this).remove();
            });
        });
    }


    /* -----------------------------------------
       6. Theme toggle (light/dark)
       Extended to sync:
         - aria-pressed on the toggle button (a11y state reflection)
         - <meta name="theme-color"> so mobile browser chrome follows theme
       No other logic changes from the original toggle implementation.
       ----------------------------------------- */
    var $themeSwitch = $('#dv-theme-switch');
    var $htmlEl = $('html');
    var $themeColorMeta = $('meta[name="theme-color"]');
    var THEME_COLOR_DARK  = '#0A0A0A';
    var THEME_COLOR_LIGHT = '#FFFFFF';

    function getPreferredTheme() {
        var stored = localStorage.getItem('dv-theme');
        if (stored) return stored;
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: light)').matches) {
            return 'light';
        }
        return 'dark';
    }

    function syncThemeIndicators(theme) {
        var isLight = (theme === 'light');
        // aria-pressed reflects the "light mode is active" state. The toggle
        // button default markup ships aria-pressed="false" for dark theme.
        if ($themeSwitch.length) {
            $themeSwitch.attr('aria-pressed', isLight ? 'true' : 'false');
        }
        // Sync the meta theme-color for mobile browser chrome.
        if ($themeColorMeta.length) {
            $themeColorMeta.attr('content', isLight ? THEME_COLOR_LIGHT : THEME_COLOR_DARK);
        }
    }

    function applyTheme(theme) {
        if (theme === 'light') {
            $htmlEl.attr('data-theme', 'light');
        } else {
            $htmlEl.removeAttr('data-theme');
        }
        localStorage.setItem('dv-theme', theme);
        syncThemeIndicators(theme);
    }

    applyTheme(getPreferredTheme());

    $themeSwitch.on('click', function () {
        var current = $htmlEl.attr('data-theme') === 'light' ? 'dark' : 'light';
        applyTheme(current);
    });

    if (window.matchMedia) {
        var mq = window.matchMedia('(prefers-color-scheme: light)');
        if (typeof mq.addEventListener === 'function') {
            mq.addEventListener('change', function (e) {
                if (!localStorage.getItem('dv-theme')) {
                    applyTheme(e.matches ? 'light' : 'dark');
                }
            });
        }
    }


    /* -----------------------------------------
       7. Back-to-top button (behavior only; styles in _back-to-top.scss)
       ----------------------------------------- */
    var $backToTop = $('<button/>', {
        'class':      'dv-back-to-top',
        'type':       'button',
        'title':      'Volver arriba',
        'aria-label': 'Volver arriba'
    });
    $backToTop.html('&#9650;');
    $('body').append($backToTop);

    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 500) {
            $backToTop.addClass('visible');
        } else {
            $backToTop.removeClass('visible');
        }
    });

    $backToTop.on('click', function () {
        if (prefersReducedMotion) {
            window.scrollTo(0, 0);
        } else {
            $('html, body').animate({ scrollTop: 0 }, 600);
        }
    });

});
