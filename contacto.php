<?php
require_once __DIR__ . '/includes/bootstrap.php';
require_once __DIR__ . '/config/mail.php';

$current_page     = 'contacto';
$page_title       = 'Contacto | DATAVANT Systems';
$page_description = 'Contacta a DATAVANT Systems para desarrollo web, bases de datos, automatización y soluciones tecnológicas profesionales.';
include __DIR__ . '/includes/head.php';
include __DIR__ . '/includes/header.php';

$csrf_token = csrf_token();
$form_ts    = time();

// Fail-closed: if the SMTP pipeline is not fully configured we must render
// the form in a disabled state and surface an honest fallback contact path.
$dv_mail_ready    = mail_is_configured();
$dv_fallback_mail = mail_fallback_contact_email();
?>

<!-- ============================================
     PAGE HEADER
     ============================================ -->
<section class="section-padding bg-dark-section dv-contact-header">
    <div class="container">
        <div class="section-title dv-animate">
            <h1>Contacto</h1>
            <span class="title-accent" aria-hidden="true"></span>
            <p>Estoy listo para escuchar tu proyecto. Cuéntame qué necesitas y te responderé a la brevedad.</p>
        </div>
    </div>
</section>

<!-- ============================================
     CONTACT SECTION
     ============================================ -->
<section class="dv-contact bg-black-section">
    <div class="container">
        <div class="row">

            <!-- Contact Info -->
            <div class="col-md-5">
                <div class="contact-info dv-animate-left">

                    <div class="contact-item">
                        <div class="contact-icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                        </div>
                        <div class="contact-detail">
                            <h4>Nombre</h4>
                            <p>Ing. Humberto Salvador Ruiz Lucio</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        </div>
                        <div class="contact-detail">
                            <h4>Teléfono</h4>
                            <a href="tel:+525621111752">+52 56 2111 1752</a>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        </div>
                        <div class="contact-detail">
                            <h4>Email</h4>
                            <a href="mailto:lucio.s.isc@gmail.com">lucio.s.isc@gmail.com</a>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M20.45 20.45h-3.56v-5.57c0-1.33-.02-3.04-1.85-3.04-1.85 0-2.13 1.45-2.13 2.94v5.67H9.36V9h3.41v1.56h.05c.48-.9 1.64-1.85 3.38-1.85 3.61 0 4.27 2.38 4.27 5.47v6.27zM5.34 7.43a2.06 2.06 0 1 1 0-4.12 2.06 2.06 0 0 1 0 4.12zM7.12 20.45H3.56V9h3.56v11.45z"/></svg>
                        </div>
                        <div class="contact-detail">
                            <h4>LinkedIn</h4>
                            <a href="https://www.linkedin.com/in/luciosalck/" target="_blank" rel="noopener noreferrer">linkedin.com/in/luciosalck</a>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><path d="M12 .5C5.37.5 0 5.87 0 12.5c0 5.3 3.44 9.8 8.2 11.39.6.11.82-.26.82-.58 0-.28-.01-1.04-.02-2.05-3.34.73-4.04-1.61-4.04-1.61-.55-1.39-1.34-1.76-1.34-1.76-1.09-.75.08-.73.08-.73 1.21.09 1.85 1.24 1.85 1.24 1.07 1.84 2.81 1.31 3.5 1 .11-.78.42-1.31.76-1.61-2.67-.3-5.47-1.33-5.47-5.93 0-1.31.47-2.38 1.24-3.22-.13-.3-.54-1.52.11-3.18 0 0 1.01-.32 3.3 1.23.96-.27 1.98-.4 3-.4s2.04.13 3 .4c2.29-1.55 3.3-1.23 3.3-1.23.66 1.66.25 2.88.12 3.18.77.84 1.23 1.91 1.23 3.22 0 4.61-2.8 5.63-5.48 5.92.43.37.82 1.1.82 2.22 0 1.6-.02 2.89-.02 3.29 0 .32.22.7.83.58C20.57 22.29 24 17.8 24 12.5 24 5.87 18.63.5 12 .5z"/></svg>
                        </div>
                        <div class="contact-detail">
                            <h4>GitHub</h4>
                            <a href="https://github.com/LucioSalva" target="_blank" rel="noopener noreferrer">github.com/LucioSalva</a>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-md-7">
                <div class="contact-form dv-animate-right">

                    <?php if (!$dv_mail_ready): ?>
                        <div class="dv-form-disabled-banner" role="alert" aria-live="polite">
                            <strong>Formulario temporalmente no operativo.</strong>
                            <p>
                                El servicio de correo aún no está configurado en este entorno, por lo que no puedo garantizar la entrega de mensajes desde este formulario.
                                <?php if ($dv_fallback_mail !== ''): ?>
                                    Mientras tanto escríbeme directamente a
                                    <a href="mailto:<?php echo htmlspecialchars($dv_fallback_mail, ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($dv_fallback_mail, ENT_QUOTES, 'UTF-8'); ?></a>
                                    y te responderé a la brevedad.
                                <?php else: ?>
                                    Mientras tanto utiliza los datos de contacto que aparecen a la izquierda.
                                <?php endif; ?>
                            </p>
                        </div>
                    <?php endif; ?>

                    <form id="dv-contact-form" method="POST" action="send_mail.php" novalidate aria-label="Formulario de contacto"<?php echo $dv_mail_ready ? '' : ' data-dv-disabled="1"'; ?>>
                        <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token, ENT_QUOTES, 'UTF-8'); ?>">
                        <input type="hidden" name="form_ts" value="<?php echo (int)$form_ts; ?>">

                        <!-- Honeypot (hidden from real users) -->
                        <div class="dv-honeypot" aria-hidden="true">
                            <label for="contact-website">Website</label>
                            <input type="text" id="contact-website" name="website" tabindex="-1" autocomplete="off">
                        </div>

                        <!-- Form response alert container -->
                        <div id="dv-form-alert" role="status" aria-live="polite" aria-atomic="true"></div>

                        <?php $dv_disabled = $dv_mail_ready ? '' : ' disabled'; ?>

                        <div class="form-group">
                            <label for="contact-nombre">Nombre <span class="text-accent" aria-hidden="true">*</span></label>
                            <input type="text" class="form-control" id="contact-nombre" name="nombre" placeholder="Tu nombre completo" required maxlength="100" autocomplete="name" aria-required="true"<?php echo $dv_disabled; ?>>
                        </div>

                        <div class="form-group">
                            <label for="contact-email">Email <span class="text-accent" aria-hidden="true">*</span></label>
                            <input type="email" class="form-control" id="contact-email" name="email" placeholder="correo@ejemplo.com" required maxlength="150" autocomplete="email" aria-required="true"<?php echo $dv_disabled; ?>>
                        </div>

                        <div class="form-group">
                            <label for="contact-telefono">Teléfono</label>
                            <input type="tel" class="form-control" id="contact-telefono" name="telefono" placeholder="+52 55 1234 5678" maxlength="20" autocomplete="tel"<?php echo $dv_disabled; ?>>
                        </div>

                        <div class="form-group">
                            <label for="contact-asunto">Asunto <span class="text-accent" aria-hidden="true">*</span></label>
                            <input type="text" class="form-control" id="contact-asunto" name="asunto" placeholder="Asunto de tu mensaje" required maxlength="200" aria-required="true"<?php echo $dv_disabled; ?>>
                        </div>

                        <div class="form-group">
                            <label for="contact-mensaje">Mensaje <span class="text-accent" aria-hidden="true">*</span></label>
                            <textarea class="form-control" id="contact-mensaje" name="mensaje" rows="5" placeholder="Describe tu proyecto o consulta..." required maxlength="2000" aria-required="true"<?php echo $dv_disabled; ?>></textarea>
                        </div>

                        <div class="form-group dv-consent-group">
                            <label class="dv-consent-label" for="contact-consent">
                                <input type="checkbox" id="contact-consent" name="privacy_consent" value="1" required aria-required="true"<?php echo $dv_disabled; ?>>
                                <span>He leído y acepto el <a href="aviso-privacidad.php" target="_blank" rel="noopener">aviso de privacidad</a>.</span>
                            </label>
                        </div>

                        <button type="submit" id="dv-submit-btn" class="btn-dv-primary dv-submit-block"<?php echo $dv_disabled; ?> aria-disabled="<?php echo $dv_mail_ready ? 'false' : 'true'; ?>"><?php echo $dv_mail_ready ? 'Enviar mensaje' : 'Formulario no disponible'; ?></button>
                    </form>

                </div>
            </div>

        </div>
    </div>
</section>

<!-- ============================================
     CTA ALTERNATIVE
     ============================================ -->
<section class="section-padding bg-dark-section">
    <div class="container">
        <div class="dv-cta-banner dv-animate">
            <h2>Contacto directo</h2>
            <p>
                También puedes escribirme directamente a
                <a href="mailto:lucio.s.isc@gmail.com">lucio.s.isc@gmail.com</a>
                o llamar al
                <a href="tel:+525621111752">+52 56 2111 1752</a>.
            </p>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
