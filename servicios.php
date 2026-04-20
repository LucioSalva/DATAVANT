<?php
$current_page     = 'servicios';
$page_title       = 'Servicios | DATAVANT Systems';
$page_description = 'Cinco núcleos de servicio: desarrollo a medida, datos y bases de datos, automatización e integración, infraestructura y soporte, y consultoría tecnológica.';
include 'includes/head.php';
include 'includes/header.php';
?>

<!-- Page Header -->
<section class="section-padding bg-dark-section dv-page-header--lg">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center">
                <h1 class="dv-animate">Mis servicios</h1>
                <div class="title-accent dv-title-accent-centered" aria-hidden="true"></div>
                <p class="dv-animate dv-animate-delay-1 dv-page-intro">
                    Trabajo en cinco núcleos claros. Cada uno resuelve un tipo concreto de problema operativo: construir el sistema, ordenar los datos, eliminar trabajo manual, sostener la infraestructura y decidir con criterio. Sin humo, sin recetas enlatadas.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Services Grid -->
<section class="dv-services">
    <div class="container">
        <div class="row">

            <!-- Service 1: Desarrollo de software a medida -->
            <div class="col-md-6 col-sm-6">
                <div class="service-card dv-animate">
                    <div class="service-card-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg>
                    </div>
                    <h3>Desarrollo de software a medida</h3>
                    <p>Construyo aplicaciones y sitios web ajustados al proceso real, no al contrario. PHP moderno, frontend semántico y accesible, y decisiones técnicas orientadas a que el código siga siendo mantenible dos años después.</p>
                    <ul class="service-benefits">
                        <li>Aplicaciones y sitios web con PHP moderno</li>
                        <li>Frontend semántico, accesible y responsive</li>
                        <li>Integración con APIs REST y servicios externos</li>
                        <li>Código mantenible, sin dependencias innecesarias</li>
                    </ul>
                </div>
            </div>

            <!-- Service 2: Datos y bases de datos -->
            <div class="col-md-6 col-sm-6">
                <div class="service-card dv-animate dv-animate-delay-1">
                    <div class="service-card-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><ellipse cx="12" cy="5" rx="9" ry="3"/><path d="M3 5v6c0 1.66 4.03 3 9 3s9-1.34 9-3V5"/><path d="M3 11v6c0 1.66 4.03 3 9 3s9-1.34 9-3v-6"/></svg>
                    </div>
                    <h3>Datos y bases de datos</h3>
                    <p>Diseño esquemas consistentes, afino consultas lentas y migro motores sin perder integridad. Si tus reportes tardan demasiado o tu información vive en varios Excel inconexos, ahí es donde entro.</p>
                    <ul class="service-benefits">
                        <li>Diseño y normalización de esquemas (PostgreSQL, MySQL)</li>
                        <li>Optimización de consultas y tuning de rendimiento</li>
                        <li>Migración segura entre motores</li>
                        <li>Respaldos automatizados e integridad referencial</li>
                    </ul>
                </div>
            </div>

            <!-- Service 3: Automatización e integración -->
            <div class="col-md-6 col-sm-6">
                <div class="service-card dv-animate dv-animate-delay-2">
                    <div class="service-card-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><polygon points="13,2 3,14 12,14 11,22 21,10 12,10 13,2"/></svg>
                    </div>
                    <h3>Automatización e integración</h3>
                    <p>Elimino tareas repetitivas con scripts y pipelines. Conecto plataformas que hoy están aisladas para que la información fluya en una sola dirección lógica y auditable.</p>
                    <ul class="service-benefits">
                        <li>Scripts y pipelines para eliminar tareas repetitivas</li>
                        <li>Integración entre plataformas y fuentes de datos</li>
                        <li>Flujos programados y procesamiento batch</li>
                        <li>Conexión de APIs y eliminación de silos</li>
                    </ul>
                </div>
            </div>

            <!-- Service 4: Infraestructura y soporte técnico -->
            <div class="col-md-6 col-sm-6">
                <div class="service-card dv-animate dv-animate-delay-3">
                    <div class="service-card-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="3" width="20" height="6" rx="1"/><rect x="2" y="15" width="20" height="6" rx="1"/><line x1="6" y1="6" x2="6.01" y2="6"/><line x1="6" y1="18" x2="6.01" y2="18"/></svg>
                    </div>
                    <h3>Infraestructura y soporte técnico</h3>
                    <p>Levanto entornos reproducibles con Docker, configuro servidores y homelab, y doy soporte presencial o remoto cuando algo se rompe. Diagnóstico, mantenimiento y resolución orientados a que el negocio no se detenga.</p>
                    <ul class="service-benefits">
                        <li>Contenedores Docker y entornos reproducibles</li>
                        <li>Configuración de servidores y homelab</li>
                        <li>Soporte presencial y remoto, diagnóstico de fallas</li>
                        <li>Mantenimiento preventivo y correctivo</li>
                    </ul>
                </div>
            </div>

            <!-- Service 5: Consultoría tecnológica -->
            <div class="col-md-6 col-sm-6 col-md-offset-3">
                <div class="service-card dv-animate">
                    <div class="service-card-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg>
                    </div>
                    <h3>Consultoría tecnológica</h3>
                    <p>Opinión técnica directa sobre stack, arquitectura, rendimiento o deuda técnica. Sin comisiones de proveedor, sin recomendar por moda. Hojas de ruta accionables y priorizadas por impacto real.</p>
                    <ul class="service-benefits">
                        <li>Selección de stack y revisión de arquitectura</li>
                        <li>Auditorías de rendimiento y deuda técnica</li>
                        <li>Hojas de ruta accionables</li>
                        <li>Criterio objetivo sin sesgos de proveedor</li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- CTA Banner -->
<section class="dv-cta-banner">
    <div class="container">
        <h2 class="dv-animate">¿Necesitas una solución a medida?</h2>
        <p class="dv-animate dv-animate-delay-1">Cuéntame tu proyecto y diseño contigo la estrategia técnica que mejor se adapte a tus objetivos y presupuesto.</p>
        <a href="contacto.php" class="btn-dv-primary dv-animate dv-animate-delay-2">Solicitar consulta <span class="arrow" aria-hidden="true">&rarr;</span></a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
