<?php
$current_page     = '404';
$page_title       = 'Página no encontrada | DATAVANT Systems';
$page_description = 'La página que buscas no existe o fue movida.';
include 'includes/head.php';
include 'includes/header.php';
?>

<section class="section-padding bg-dark-section dv-404">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2 text-center dv-animate">
                <h1 class="dv-404__code">
                    <span class="title-highlight">404</span>
                </h1>
                <h2 class="dv-404__title">Página no encontrada</h2>
                <p class="dv-404__copy">
                    La página que buscas no existe, fue movida o no está disponible en este momento.
                </p>
                <a href="index.php" class="btn-dv-primary btn-dv-lg">Volver al inicio</a>
                <a href="contacto.php" class="btn-dv-outline btn-dv-lg dv-ml-sm">Contacto</a>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
