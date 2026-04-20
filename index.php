<?php
$current_page     = 'inicio';
$page_title       = 'DATAVANT Systems | Soluciones Tecnológicas Profesionales';
$page_description = 'Desarrollo web, bases de datos, automatización e infraestructura tecnológica. Soluciones profesionales para empresas que buscan resultados reales.';
include 'includes/head.php';
include 'includes/header.php';
?>

<!-- ============================================
     HERO SECTION
     ============================================ -->
<section class="dv-hero">
    <div class="hero-bg-grid" aria-hidden="true"></div>
    <div class="hero-glow glow-1" aria-hidden="true"></div>
    <div class="hero-glow glow-2" aria-hidden="true"></div>

    <div class="container">
        <div class="row">
            <div class="col-md-10 hero-content hero-content--lead">

                <span class="hero-badge dv-animate">Desarrollo web &middot; Automatización &middot; Soporte técnico</span>

                <h1 class="hero-title hero-title--lead dv-animate dv-animate-delay-1">
                    Transformo <span class="title-highlight">procesos manuales</span> en sistemas web funcionales para que tu organización trabaje con más <span class="title-highlight">control</span>, menos errores y mejor seguimiento.
                </h1>

                <p class="hero-subtitle hero-subtitle--lead dv-animate dv-animate-delay-2">
                    Desarrollo soluciones web a medida, automatización de procesos, control de información y soporte técnico para instituciones, negocios y equipos que necesitan dejar atrás el desorden operativo.
                </p>

                <div class="hero-cta-group dv-animate dv-animate-delay-3">
                    <a href="contacto.php" class="btn-dv-primary btn-dv-lg">Solicitar diagnóstico</a>
                    <a href="proyectos.php" class="btn-dv-outline btn-dv-lg">Ver proyectos reales</a>
                </div>

            </div>
        </div>
    </div>
</section>


<!-- ============================================
     SERVICES OVERVIEW
     ============================================ -->
<section class="dv-services-overview">
    <div class="container">

        <div class="section-title dv-animate">
            <h2>Lo que ofrezco</h2>
            <span class="title-accent" aria-hidden="true"></span>
            <p>Soluciones técnicas enfocadas en lo que tu negocio realmente necesita para operar, crecer y competir.</p>
        </div>

        <div class="row">
            <!-- Desarrollo a medida -->
            <div class="col-md-4 col-sm-6 dv-animate dv-animate-delay-1">
                <div class="service-mini-card">
                    <div class="service-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
                    </div>
                    <h4>Desarrollo a medida</h4>
                    <p>Aplicaciones y sitios web ajustados al proceso real. PHP moderno, frontend semántico y código mantenible.</p>
                </div>
            </div>

            <!-- Datos y bases de datos -->
            <div class="col-md-4 col-sm-6 dv-animate dv-animate-delay-2">
                <div class="service-mini-card">
                    <div class="service-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M3 5v6c0 1.66 4.03 3 9 3s9-1.34 9-3V5"/><path d="M3 11v6c0 1.66 4.03 3 9 3s9-1.34 9-3v-6"/></svg>
                    </div>
                    <h4>Datos y bases de datos</h4>
                    <p>Diseño, normalización y optimización en PostgreSQL y MySQL. Migración segura y respaldos automatizados.</p>
                </div>
            </div>

            <!-- Automatización e integración -->
            <div class="col-md-4 col-sm-6 dv-animate dv-animate-delay-3">
                <div class="service-mini-card">
                    <div class="service-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><polygon points="13,2 3,14 12,14 11,22 21,10 12,10 13,2"/></svg>
                    </div>
                    <h4>Automatización e integración</h4>
                    <p>Scripts, pipelines y APIs para eliminar tareas repetitivas y conectar plataformas que hoy están aisladas.</p>
                </div>
            </div>

            <!-- Infraestructura y soporte -->
            <div class="col-md-4 col-md-offset-2 col-sm-6 dv-animate dv-animate-delay-1">
                <div class="service-mini-card">
                    <div class="service-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="6" rx="1"/><rect x="2" y="15" width="20" height="6" rx="1"/><line x1="6" y1="6" x2="6.01" y2="6"/><line x1="6" y1="18" x2="6.01" y2="18"/></svg>
                    </div>
                    <h4>Infraestructura y soporte</h4>
                    <p>Docker, servidores, homelab y soporte presencial o remoto. Diagnóstico y mantenimiento que no detienen la operación.</p>
                </div>
            </div>

            <!-- Consultoría tecnológica -->
            <div class="col-md-4 col-sm-6 dv-animate dv-animate-delay-2">
                <div class="service-mini-card">
                    <div class="service-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
                    </div>
                    <h4>Consultoría tecnológica</h4>
                    <p>Opinión técnica directa sobre stack, arquitectura y deuda técnica. Hojas de ruta priorizadas por impacto real.</p>
                </div>
            </div>
        </div>

        <div class="text-center dv-mt-md">
            <a href="servicios.php" class="btn-dv-ghost">Ver todos los servicios <span class="arrow" aria-hidden="true">&#10148;</span></a>
        </div>

    </div>
</section>


<!-- ============================================
     TRUST / WHY US
     ============================================ -->
<section class="dv-trust">
    <div class="container">

        <div class="section-title dv-animate">
            <h2>Por qué DATAVANT Systems</h2>
            <span class="title-accent" aria-hidden="true"></span>
            <p>No vendo tecnología por moda. Resuelvo problemas reales con ingeniería aplicada.</p>
        </div>

        <div class="row">
            <!-- 01 -->
            <div class="col-md-3 col-sm-6 dv-animate dv-animate-delay-1">
                <div class="trust-item">
                    <div class="trust-number">01</div>
                    <h4>Soluciones reales</h4>
                    <p>Cada proyecto parte de un problema concreto. No implemento tecnología innecesaria: diseño lo que funciona para tu contexto específico.</p>
                </div>
            </div>

            <!-- 02 -->
            <div class="col-md-3 col-sm-6 dv-animate dv-animate-delay-2">
                <div class="trust-item">
                    <div class="trust-number">02</div>
                    <h4>Profundidad técnica</h4>
                    <p>Domino el stack completo: desde la arquitectura del servidor hasta la interfaz de usuario. Eso me permite tomar decisiones técnicas sólidas.</p>
                </div>
            </div>

            <!-- 03 -->
            <div class="col-md-3 col-sm-6 dv-animate dv-animate-delay-3">
                <div class="trust-item">
                    <div class="trust-number">03</div>
                    <h4>Comunicación directa</h4>
                    <p>Hablas directo con quien construye tu solución. Sin intermediarios, sin capas de gestión innecesarias. Respuestas claras y tiempos reales.</p>
                </div>
            </div>

            <!-- 04 -->
            <div class="col-md-3 col-sm-6 dv-animate dv-animate-delay-4">
                <div class="trust-item">
                    <div class="trust-number">04</div>
                    <h4>Mejora continua</h4>
                    <p>La tecnología no es estática y yo tampoco. Actualizo, optimizo y evoluciono cada sistema que entrego.</p>
                </div>
            </div>
        </div>

    </div>
</section>


<!-- ============================================
     SUPPORT HIGHLIGHT
     ============================================ -->
<section class="section-padding bg-dark-section">
    <div class="container">
        <div class="row">
            <div class="col-md-6 dv-animate-left">
                <h2>¿Necesitas ayuda técnica?</h2>
                <span class="title-accent" aria-hidden="true"></span>
                <p class="dv-support-lead dv-mt-md">
                    Desde DATAVANT Systems ofrezco soporte técnico profesional para empresas, negocios y usuarios que necesitan resolver problemas reales. Desde el diagnóstico de fallas hasta el mantenimiento preventivo, estoy listo para ayudarte.
                </p>
                <ul class="dv-check-list">
                    <li>Soporte presencial y remoto</li>
                    <li>Diagnóstico y resolución de fallas</li>
                    <li>Mantenimiento preventivo y correctivo</li>
                    <li>Instalación y configuración de software</li>
                    <li>Optimización de rendimiento en equipos</li>
                </ul>
                <a href="contacto.php" class="btn-dv-primary">Solicitar soporte</a>
                <a href="servicios.php" class="btn-dv-outline dv-ml-sm">Ver servicios</a>
            </div>
            <div class="col-md-5 col-md-offset-1 dv-animate-right">
                <div class="dv-support-card">
                    <h4>Áreas de soporte</h4>
                    <div class="dv-support-item">
                        <div class="dv-support-icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                        </div>
                        <div><h5>Equipos de cómputo</h5><p>Diagnóstico, limpieza, reparación y optimización de PCs y laptops.</p></div>
                    </div>
                    <div class="dv-support-item">
                        <div class="dv-support-icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
                        </div>
                        <div><h5>Sistemas y software</h5><p>Instalación, configuración, actualización y resolución de conflictos.</p></div>
                    </div>
                    <div class="dv-support-item">
                        <div class="dv-support-icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        </div>
                        <div><h5>Redes e infraestructura</h5><p>Configuración de redes, conectividad, servidores y seguridad básica.</p></div>
                    </div>
                    <div class="dv-support-item">
                        <div class="dv-support-icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/></svg>
                        </div>
                        <div><h5>Mantenimiento preventivo</h5><p>Programas regulares de revisión para evitar fallas y tiempos de inactividad.</p></div>
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
        <h2>¿Listo para construir algo real?</h2>
        <p>Cuéntame qué necesitas. Sin compromiso, sin plantillas genéricas. Solo una conversación técnica honesta.</p>
        <a href="contacto.php" class="btn-dv-primary btn-dv-lg">Contáctame ahora</a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
