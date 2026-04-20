<?php
$current_page     = 'nosotros';
$page_title       = 'Sobre mí | DATAVANT Systems';
$page_description = 'Conoce a DATAVANT Systems: enfoque técnico, visión profesional y el ingeniero detrás de soluciones tecnológicas que funcionan.';
include 'includes/head.php';
include 'includes/header.php';
?>

<!-- ============================================
     PAGE HEADER
     ============================================ -->
<section class="bg-dark-section section-padding dv-nosotros-hero">
    <div class="container">
        <div class="row">
            <div class="col-md-8 dv-animate">
                <h1>Sobre mí</h1>
                <p>
                    Detrás de cada línea de código hay criterio técnico, enfoque en resultados y la convicción de que la tecnología debe resolver, no complicar.
                </p>
            </div>
        </div>
    </div>
</section>


<!-- ============================================
     ABOUT CONTENT
     ============================================ -->
<section class="dv-about bg-black-section">
    <div class="container">
        <div class="row">

            <!-- About Text -->
            <div class="col-md-10 col-md-offset-1">

                <div class="about-content dv-animate">
                    <p>
                        <strong class="dv-brand-strong">DATAVANT Systems</strong> nace de una idea clara: ofrecer soluciones tecnológicas que realmente funcionan. No soy una consultora genérica que vende horas; soy un ingeniero que entiende el problema antes de escribir la primera línea de código.
                    </p>
                    <p>
                        Trabajo con empresas que necesitan resultados tangibles: sitios web que convierten, bases de datos que escalan, procesos automatizados que eliminan el trabajo manual y sistemas de soporte que mantienen la operación estable. Mi stack incluye PHP, MySQL, PostgreSQL, servidores Linux, scripting en Bash y Python, y herramientas de infraestructura moderna.
                    </p>
                    <p>
                        Lo que me distingue no es la tecnología que uso, sino cómo la aplico. Cada proyecto se aborda con rigor técnico, comunicación transparente y un compromiso real con la entrega. Si algo no agrega valor, no lo implemento. Si hay una forma más simple y eficiente de resolver un problema, la encuentro.
                    </p>
                </div>

                <!-- Founder Card -->
                <div class="founder-card dv-animate dv-animate-delay-2">
                    <div class="founder-avatar" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" width="100%" height="100%" role="img" aria-hidden="true">
                            <defs>
                                <linearGradient id="dvFounderGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" stop-color="#81F076"/>
                                    <stop offset="100%" stop-color="#55F6CB"/>
                                </linearGradient>
                            </defs>
                            <rect width="100" height="100" rx="50" fill="url(#dvFounderGrad)"/>
                            <text x="50" y="58" text-anchor="middle" font-family="Ubuntu, sans-serif" font-size="36" font-weight="700" fill="#000000" letter-spacing="1">HS</text>
                        </svg>
                    </div>
                    <div class="founder-info">
                        <h3>Ing. Humberto Salvador Ruiz Lucio</h3>
                        <span class="founder-title">Fundador &amp; Director Técnico</span>
                        <p>
                            Ingeniero en Sistemas Computacionales con una trayectoria construida sobre proyectos reales, no certificaciones decorativas. Desde el diseño de bases de datos empresariales hasta la implementación de aplicaciones web completas, mi enfoque siempre ha sido el mismo: entender el problema a fondo y construir la solución correcta.
                        </p>
                        <p>
                            Con experiencia en desarrollo full-stack, administración de servidores, automatización de procesos y soporte técnico especializado, lidero cada proyecto de DATAVANT Systems con un enfoque práctico y orientado a resultados. Creo firmemente en la comunicación directa con el cliente, en la documentación como herramienta profesional y en que la mejor tecnología es la que resuelve sin complicar.
                        </p>
                        <p>
                            Cuando no estoy resolviendo problemas técnicos, estoy investigando nuevas herramientas, optimizando flujos de trabajo o explorando formas de hacer las cosas mejor.
                        </p>
                        <div class="founder-links">
                            <a href="https://www.linkedin.com/in/luciosalck/" target="_blank" rel="noopener noreferrer" aria-label="Perfil de LinkedIn">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20.45 20.45h-3.56v-5.57c0-1.33-.02-3.04-1.85-3.04-1.85 0-2.13 1.45-2.13 2.94v5.67H9.36V9h3.41v1.56h.05c.48-.9 1.64-1.85 3.38-1.85 3.61 0 4.27 2.38 4.27 5.47v6.27zM5.34 7.43a2.06 2.06 0 1 1 0-4.12 2.06 2.06 0 0 1 0 4.12zM7.12 20.45H3.56V9h3.56v11.45z"/></svg>
                                LinkedIn
                            </a>
                            <a href="https://github.com/LucioSalva" target="_blank" rel="noopener noreferrer" aria-label="Perfil de GitHub">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 .5C5.37.5 0 5.87 0 12.5c0 5.3 3.44 9.8 8.2 11.39.6.11.82-.26.82-.58 0-.28-.01-1.04-.02-2.05-3.34.73-4.04-1.61-4.04-1.61-.55-1.39-1.34-1.76-1.34-1.76-1.09-.75.08-.73.08-.73 1.21.09 1.85 1.24 1.85 1.24 1.07 1.84 2.81 1.31 3.5 1 .11-.78.42-1.31.76-1.61-2.67-.3-5.47-1.33-5.47-5.93 0-1.31.47-2.38 1.24-3.22-.13-.3-.54-1.52.11-3.18 0 0 1.01-.32 3.3 1.23.96-.27 1.98-.4 3-.4s2.04.13 3 .4c2.29-1.55 3.3-1.23 3.3-1.23.66 1.66.25 2.88.12 3.18.77.84 1.23 1.91 1.23 3.22 0 4.61-2.8 5.63-5.48 5.92.43.37.82 1.1.82 2.22 0 1.6-.02 2.89-.02 3.29 0 .32.22.7.83.58C20.57 22.29 24 17.8 24 12.5 24 5.87 18.63.5 12 .5z"/></svg>
                                GitHub
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Values Grid -->
        <div class="values-grid">
            <div class="section-title dv-animate dv-mt-lg">
                <h2>Mis valores</h2>
                <span class="title-accent" aria-hidden="true"></span>
                <p>Los principios que guían cada decisión técnica y cada interacción con mis clientes.</p>
            </div>

            <div class="row">
                <!-- Precisión Técnica -->
                <div class="col-md-3 col-sm-6 dv-animate dv-animate-delay-1">
                    <div class="value-item">
                        <div class="value-icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 1 1-2.83 2.83l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 1 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 1 1-2.83-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 1 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 1 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 1 1 2.83 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 1 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                        </div>
                        <h4>Precisión Técnica</h4>
                        <p>Cada solución se construye con atención al detalle. El código limpio, la arquitectura bien pensada y las buenas prácticas no son opcionales: son el estándar.</p>
                    </div>
                </div>

                <!-- Comunicación Directa -->
                <div class="col-md-3 col-sm-6 dv-animate dv-animate-delay-2">
                    <div class="value-item">
                        <div class="value-icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="20,6 9,17 4,12"/></svg>
                        </div>
                        <h4>Comunicación Directa</h4>
                        <p>Sin jerga innecesaria, sin capas de gestión. Hablo claro sobre avances, tiempos, limitaciones y alternativas. La transparencia genera confianza.</p>
                    </div>
                </div>

                <!-- Enfoque en Resultados -->
                <div class="col-md-3 col-sm-6 dv-animate dv-animate-delay-3">
                    <div class="value-item">
                        <div class="value-icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="12" r="6"/><circle cx="12" cy="12" r="2"/></svg>
                        </div>
                        <h4>Enfoque en Resultados</h4>
                        <p>La tecnología es un medio, no un fin. Cada decisión técnica se evalúa por su impacto real en el negocio del cliente, no por su complejidad o novedad.</p>
                    </div>
                </div>

                <!-- Mejora Continua -->
                <div class="col-md-3 col-sm-6 dv-animate dv-animate-delay-4">
                    <div class="value-item">
                        <div class="value-icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><polyline points="23,4 23,10 17,10"/><polyline points="1,20 1,14 7,14"/><path d="M3.51 9a9 9 0 0 1 14.85-3.36L23 10"/><path d="M20.49 15a9 9 0 0 1-14.85 3.36L1 14"/></svg>
                        </div>
                        <h4>Mejora Continua</h4>
                        <p>Cada proyecto terminado es una base para mejorar. Reviso, optimizo y actualizo porque creo que entregar es solo el primer paso.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>


<!-- ============================================
     CTA BANNER
     ============================================ -->
<section class="dv-cta-banner dv-animate">
    <div class="container">
        <h2>¿Quieres trabajar conmigo?</h2>
        <p>Si buscas un ingeniero que entienda tu problema y construya la solución correcta, estoy listo para conversar.</p>
        <a href="contacto.php" class="btn-dv-primary btn-dv-lg">Iniciar conversación</a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
