<?php
$current_page     = 'recursos';
$page_title       = 'Recursos | DATAVANT Systems';
$page_description = 'Artículos técnicos sobre PostgreSQL, digitalización de trámites y homelab con Docker escritos desde la experiencia real de DATAVANT Systems.';
include 'includes/head.php';
include 'includes/header.php';
?>

<!-- ============================================
     PAGE HEADER
     ============================================ -->
<section class="section-padding bg-dark-section dv-page-header--md">
    <div class="container">
        <div class="section-title dv-animate">
            <span class="eyebrow">Recursos</span>
            <h1>Artículos técnicos</h1>
            <span class="title-accent dv-title-accent-centered" aria-hidden="true"></span>
            <p class="dv-page-intro">Notas prácticas escritas desde lo que me toca ver todos los días: bases de datos que no responden, procesos que aún viven en papel y entornos de laboratorio para probar sin romper producción.</p>
        </div>
    </div>
</section>

<!-- ============================================
     ARTICLES GRID
     ============================================ -->
<section class="section-padding dv-resources">
    <div class="container">
        <div class="row">

            <article class="col-md-4 col-sm-6 dv-animate dv-animate-delay-1">
                <a class="dv-resource-card" href="recursos/indexado-postgresql.php">
                    <div class="dv-resource-card__meta">
                        <span class="dv-resource-card__category">Bases de datos</span>
                        <span class="dv-resource-card__read">7 min</span>
                    </div>
                    <h2 class="dv-resource-card__title">Por qué tu consulta PostgreSQL es lenta aunque tengas un índice</h2>
                    <p class="dv-resource-card__excerpt">Un índice no garantiza que se use. Recorremos casos reales donde el optimizer lo ignora y qué cambiar para que vuelva a servir: orden de columnas, índices parciales, funciones en el WHERE.</p>
                    <div class="dv-resource-card__footer">
                        <time datetime="2026-04-16">16 abr 2026</time>
                        <span class="dv-resource-card__cta">Leer artículo &rarr;</span>
                    </div>
                </a>
            </article>

            <article class="col-md-4 col-sm-6 dv-animate dv-animate-delay-2">
                <a class="dv-resource-card" href="recursos/digitalizacion-tramites.php">
                    <div class="dv-resource-card__meta">
                        <span class="dv-resource-card__category">Procesos</span>
                        <span class="dv-resource-card__read">6 min</span>
                    </div>
                    <h2 class="dv-resource-card__title">Cómo empezar a digitalizar un trámite sin rehacer todo el proceso</h2>
                    <p class="dv-resource-card__excerpt">El error habitual: intentar reinventar el trámite completo con un sistema nuevo. La alternativa práctica es capturar datos sin cambiar el flujo e iterar sobre lo que ya funciona.</p>
                    <div class="dv-resource-card__footer">
                        <time datetime="2026-04-16">16 abr 2026</time>
                        <span class="dv-resource-card__cta">Leer artículo &rarr;</span>
                    </div>
                </a>
            </article>

            <article class="col-md-4 col-sm-6 dv-animate dv-animate-delay-3">
                <a class="dv-resource-card" href="recursos/docker-homelab.php">
                    <div class="dv-resource-card__meta">
                        <span class="dv-resource-card__category">Infraestructura</span>
                        <span class="dv-resource-card__read">8 min</span>
                    </div>
                    <h2 class="dv-resource-card__title">Armando un homelab con Docker para desarrollo serio sin gastar en la nube</h2>
                    <p class="dv-resource-card__excerpt">Un equipo viejo, Docker Compose y una red interna alcanzan para tener PostgreSQL, un proxy y dos o tres servicios propios corriendo. Te cuento cómo lo armo yo.</p>
                    <div class="dv-resource-card__footer">
                        <time datetime="2026-04-16">16 abr 2026</time>
                        <span class="dv-resource-card__cta">Leer artículo &rarr;</span>
                    </div>
                </a>
            </article>

        </div>
    </div>
</section>

<!-- CTA -->
<section class="dv-cta-banner dv-animate">
    <div class="container">
        <h2>¿Te interesa que profundice en algún tema?</h2>
        <p>Si hay algo específico que quieres ver en detalle, escríbeme. Los siguientes artículos los escribo pensando en problemas reales que llegan por correo.</p>
        <a href="contacto.php" class="btn-dv-primary btn-dv-lg">Enviar sugerencia</a>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
