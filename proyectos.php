<?php
$current_page     = 'proyectos';
$page_title       = 'Proyectos | DATAVANT Systems';
$page_description = 'Experiencia aplicable en sector público, pyme y educación, más un caso de estudio representativo y estructura lista para testimonios.';
include 'includes/head.php';
include 'includes/header.php';
?>

<!-- ============================================
     PAGE HEADER
     ============================================ -->
<section class="section-padding bg-dark-section dv-cases-intro dv-page-header--md">
    <div class="container">
        <div class="section-title dv-animate">
            <span class="eyebrow">Experiencia aplicable</span>
            <h1>Proyectos y experiencia</h1>
            <span class="title-accent"></span>
            <p>Esta página muestra el tipo de problemas que puedo ayudarte a resolver: experiencia por sector, un caso de estudio representativo y casos reales en los que he participado. Todo lo que ves aquí está marcado como real o como ejemplo; nada inventado.</p>
        </div>
    </div>
</section>

<!-- ============================================
     EXPERIENCE BY SECTOR
     ============================================ -->
<section class="section-padding dv-experience-sectors">
    <div class="container">
        <div class="section-title dv-animate">
            <h2>Experiencia por sector</h2>
            <span class="title-accent" aria-hidden="true"></span>
            <p>El tipo de contextos en los que mi enfoque técnico aporta más valor. Son categorías, no clientes concretos.</p>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-6 dv-animate dv-animate-delay-1">
                <div class="dv-sector-card">
                    <div class="dv-sector-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18"/><path d="M5 21V7l7-4 7 4v14"/><path d="M9 9h1"/><path d="M9 13h1"/><path d="M9 17h1"/><path d="M14 9h1"/><path d="M14 13h1"/><path d="M14 17h1"/></svg>
                    </div>
                    <h3>Sector público y digitalización de trámites</h3>
                    <p>Construcción de plataformas internas para ayuntamientos y dependencias. Captura estructurada, validación por perfil (ciudadano, revisor, administrador) y flujos documentales auditables que reducen el papel y el retrabajo manual.</p>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 dv-animate dv-animate-delay-2">
                <div class="dv-sector-card">
                    <div class="dv-sector-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M3 3h18v4H3z"/><path d="M5 7v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7"/><path d="M9 12h6"/><path d="M9 16h6"/></svg>
                    </div>
                    <h3>Pequeña y mediana empresa: automatización</h3>
                    <p>Equipos que hoy viven en hojas de cálculo, correos y plantillas de Word. Los traduzco a un sistema web pequeño pero sólido: formularios estructurados, base de datos ordenada y reportes automáticos. Sin plataformas sobredimensionadas.</p>
                </div>
            </div>

            <div class="col-md-4 col-sm-6 dv-animate dv-animate-delay-3">
                <div class="dv-sector-card">
                    <div class="dv-sector-icon" aria-hidden="true">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6"/><path d="M6 12.5v5a2 2 0 0 0 1.1 1.79L12 22l4.9-2.71A2 2 0 0 0 18 17.5v-5"/><path d="M2 10l10-5 10 5-10 5z"/></svg>
                    </div>
                    <h3>Educación y capacitación técnica</h3>
                    <p>Soporte a departamentos académicos con rediseño de portales, mejora de la experiencia para alumnos y administrativos, y apoyo en procesos de captura de datos curriculares y servicios escolares.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================
     CASE STUDIES (REAL)
     ============================================ -->
<section class="dv-cases">
    <div class="container">

        <div class="section-title dv-animate">
            <h2>Casos reales en los que he participado</h2>
            <span class="title-accent" aria-hidden="true"></span>
            <p>Proyectos en los que intervine directamente como desarrollador. Sin cifras inventadas: lo que describo es lo que realmente se construyó.</p>
        </div>

        <!-- ================== CASE 1 (REAL) ================== -->
        <article class="case-study dv-animate" aria-labelledby="case-1-title">
            <header class="case-study__header">
                <div class="case-study__index" aria-hidden="true">01</div>
                <div class="case-study__heading">
                    <span class="case-study__client">Ayuntamiento de Ecatepec</span>
                    <h2 class="case-study__title" id="case-1-title">Sistema interno para control y seguimiento presupuestal</h2>
                    <span class="case-badge case-badge--gov" aria-label="Aplicado en entorno gubernamental real">Aplicado en entorno gubernamental real</span>
                </div>
            </header>

            <div class="case-study__body">
                <div class="case-block">
                    <span class="case-block__label">Contexto</span>
                    <p>Participación en el desarrollo de una plataforma interna orientada al control presupuestal, con estructura de datos, seguimiento operativo y organización de información clave para mejorar la administración diaria.</p>
                </div>

                <div class="case-block">
                    <span class="case-block__label">Problema</span>
                    <p>La gestión presupuestal requiere control detallado, organización clara de partidas, seguimiento continuo y una estructura que permita trabajar con información consistente y útil para la operación diaria.</p>
                </div>

                <div class="case-block">
                    <span class="case-block__label">Solución</span>
                    <p>Se trabajó en una plataforma web con lógica orientada al control presupuestal: estructura de datos, organización de catálogos, formularios operativos, consultas y bases para seguimiento más claro de la información.</p>
                </div>

                <div class="case-block">
                    <span class="case-block__label">Stack y enfoque</span>
                    <div class="case-tags">
                        <span class="case-tag">PHP</span>
                        <span class="case-tag">PostgreSQL</span>
                        <span class="case-tag">HTML5</span>
                        <span class="case-tag">JavaScript</span>
                        <span class="case-tag">Bootstrap</span>
                        <span class="case-tag">Lógica de negocio personalizada</span>
                    </div>
                </div>

                <div class="case-block case-block--result">
                    <span class="case-block__label">Resultado</span>
                    <p>Una solución más ordenada, estructurada y funcional que hoy permite un mejor control, organización y seguimiento del presupuesto dentro de la operación diaria.</p>
                </div>

                <div class="case-status">
                    <span class="case-status__dot" aria-hidden="true"></span>
                    <span class="case-status__label">Estado:</span>
                    <span class="case-status__value">Sistema en producción y en uso operativo, con mejoras continuas de optimización y evolución funcional.</span>
                </div>
            </div>
        </article>

        <!-- ================== CASE 2 (REAL) ================== -->
        <article class="case-study dv-animate dv-animate-delay-1" aria-labelledby="case-2-title">
            <header class="case-study__header">
                <div class="case-study__index" aria-hidden="true">02</div>
                <div class="case-study__heading">
                    <span class="case-study__client">Ayuntamiento de Ecatepec - REMTYS</span>
                    <h2 class="case-study__title" id="case-2-title">Digitalización de trámites REMTYS: carga documental, validación y flujo administrativo</h2>
                </div>
            </header>

            <div class="case-study__body">
                <div class="case-block">
                    <span class="case-block__label">Contexto</span>
                    <p>Participación en REMTYS, la plataforma de trámites del Ayuntamiento de Ecatepec, enfocada en registro de usuarios, captura de expedientes, carga documental y validación de información dentro de un flujo digital controlado.</p>
                </div>

                <div class="case-block">
                    <span class="case-block__label">Problema</span>
                    <p>Los trámites y la revisión de expedientes generaban retrasos, inconsistencias, validaciones manuales repetitivas y poca claridad en el seguimiento documental de cada ciudadano.</p>
                </div>

                <div class="case-block">
                    <span class="case-block__label">Solución</span>
                    <p>Mejora del flujo completo: captura de expedientes, carga de documentos, validaciones frontend y backend, revisión administrativa y experiencia de uso diferenciada por perfil (ciudadano, revisor, administrador).</p>
                </div>

                <div class="case-block">
                    <span class="case-block__label">Stack y enfoque</span>
                    <div class="case-tags">
                        <span class="case-tag">PHP</span>
                        <span class="case-tag">HTML5</span>
                        <span class="case-tag">JavaScript</span>
                        <span class="case-tag">Bootstrap</span>
                        <span class="case-tag">Validaciones cliente + servidor</span>
                        <span class="case-tag">Enfoque en flujo operativo</span>
                    </div>
                </div>

                <div class="case-block case-block--result">
                    <span class="case-block__label">Resultado</span>
                    <p>Proceso REMTYS reforzado con un flujo documental más claro, validaciones consistentes y una experiencia operativa mejor alineada al trámite administrativo real.</p>
                </div>

                <div class="case-status">
                    <span class="case-status__dot" aria-hidden="true"></span>
                    <span class="case-status__label">Estado:</span>
                    <span class="case-status__value">Sistema en operación, con evolución funcional y mejoras continuas.</span>
                </div>
            </div>
        </article>

        <!-- ================== CASE 3 (REPRESENTATIVE TEMPLATE) ================== -->
        <article class="case-study case-study--template dv-animate dv-animate-delay-2" aria-labelledby="case-3-title">
            <header class="case-study__header">
                <div class="case-study__index" aria-hidden="true">03</div>
                <div class="case-study__heading">
                    <span class="case-study__client">Ejemplo representativo</span>
                    <h2 class="case-study__title" id="case-3-title">Digitalización de captura de datos en una oficina administrativa</h2>
                    <span class="case-badge case-badge--template" aria-label="Ejemplo representativo del tipo de solución">Ejemplo representativo</span>
                </div>
            </header>

            <div class="case-study__body">
                <div class="case-block">
                    <span class="case-block__label">Contexto</span>
                    <p>Una oficina administrativa de tamaño mediano (una decena de capturistas, uno o dos supervisores) que registra información operativa diariamente: trámites, solicitudes internas, incidencias o formatos de control.</p>
                </div>

                <div class="case-block">
                    <span class="case-block__label">Reto</span>
                    <p>Toda la información vive en hojas de cálculo compartidas por correo, con versiones duplicadas, errores de captura, columnas inconsistentes y reportes manuales que cada fin de mes se arman copiando y pegando.</p>
                </div>

                <div class="case-block">
                    <span class="case-block__label">Solución</span>
                    <p>Un formulario web con validaciones en cliente y servidor, alimentando una base PostgreSQL normalizada. Un panel de consulta con filtros por fecha, tipo y responsable. Reportes automáticos exportables a CSV y, cuando aplica, integración ligera con el correo institucional para alertas. Stack <strong>PHP 8 + PostgreSQL + HTML semántico + JavaScript vanilla</strong>: sin framework pesado, sin dependencias mensuales.</p>
                </div>

                <div class="case-block">
                    <span class="case-block__label">Stack y enfoque</span>
                    <div class="case-tags">
                        <span class="case-tag">PHP 8</span>
                        <span class="case-tag">PostgreSQL</span>
                        <span class="case-tag">HTML5 + JS vanilla</span>
                        <span class="case-tag">Bootstrap 3</span>
                        <span class="case-tag">Automatización de reportes</span>
                    </div>
                </div>

                <div class="case-block case-block--result">
                    <span class="case-block__label">Resultado esperado</span>
                    <p>Se reducen los errores de captura al sustituir celdas libres por campos validados. La información queda centralizada y auditable. El equipo supervisor deja de dedicar horas al cierre mensual porque los reportes se generan solos. El cambio es progresivo, no disruptivo: el mismo personal sigue operando con una interfaz sencilla.</p>
                </div>

                <div class="dv-template-note" role="note">
                    <strong>Nota:</strong> este es un ejemplo representativo del tipo de solución que puedo implementar. No describe a un cliente específico. Para referencias concretas contáctame.
                </div>
            </div>
        </article>

    </div>
</section>

<!-- ============================================
     TESTIMONIALS (HONEST PLACEHOLDERS)
     ============================================ -->
<section class="section-padding bg-dark-section dv-testimonials">
    <div class="container">
        <div class="section-title dv-animate">
            <h2>Testimonios</h2>
            <span class="title-accent" aria-hidden="true"></span>
            <p>Estoy recopilando testimonios de proyectos recientes. Estos espacios quedan reservados hasta publicar los reales.</p>
        </div>

        <div class="row">
            <div class="col-md-4 col-sm-6 dv-animate dv-animate-delay-1">
                <article class="dv-testimonial" data-state="placeholder" aria-label="Testimonio pendiente de publicación">
                    <div class="dv-testimonial__quote" aria-hidden="true">&ldquo;&rdquo;</div>
                    <p class="dv-testimonial__body">Espacio reservado para testimonio de cliente.</p>
                    <footer class="dv-testimonial__meta">
                        <span class="dv-testimonial__author">Pendiente de publicación</span>
                    </footer>
                </article>
            </div>
            <div class="col-md-4 col-sm-6 dv-animate dv-animate-delay-2">
                <article class="dv-testimonial" data-state="placeholder" aria-label="Testimonio pendiente de publicación">
                    <div class="dv-testimonial__quote" aria-hidden="true">&ldquo;&rdquo;</div>
                    <p class="dv-testimonial__body">Espacio reservado para testimonio de cliente.</p>
                    <footer class="dv-testimonial__meta">
                        <span class="dv-testimonial__author">Pendiente de publicación</span>
                    </footer>
                </article>
            </div>
            <div class="col-md-4 col-sm-6 dv-animate dv-animate-delay-3">
                <article class="dv-testimonial" data-state="placeholder" aria-label="Testimonio pendiente de publicación">
                    <div class="dv-testimonial__quote" aria-hidden="true">&ldquo;&rdquo;</div>
                    <p class="dv-testimonial__body">Espacio reservado para testimonio de cliente.</p>
                    <footer class="dv-testimonial__meta">
                        <span class="dv-testimonial__author">Pendiente de publicación</span>
                    </footer>
                </article>
            </div>
        </div>

        <p class="dv-testimonials-note text-center dv-animate">
            <em>Recopilando testimonios de proyectos recientes. Si trabajamos juntos y quieres aparecer aquí, avísame.</em>
        </p>
    </div>
</section>

<!-- ============================================
     CLOSING BLOCK
     ============================================ -->
<section class="section-padding dv-cases-closing">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="cases-closing dv-animate">
                    <p class="cases-closing__lead">Cada proyecto responde a una necesidad distinta, pero todos comparten el mismo enfoque: construir soluciones útiles, funcionales y alineadas a procesos reales.</p>
                    <p class="cases-closing__body">Si tu organización necesita ordenar información, mejorar un flujo interno o construir una plataforma más clara y funcional, puedo ayudarte a desarrollar una solución adecuada a ese contexto.</p>

                    <div class="cases-closing__cta">
                        <a href="contacto.php" class="btn-dv-primary btn-dv-lg">Quiero una solución similar</a>
                        <a href="servicios.php" class="btn-dv-ghost dv-cases-closing__secondary">Ver todos mis servicios</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
