<?php
/**
 * DATAVANT Systems - Header / Navigation
 */
?>
<!-- Navigation -->
<nav class="navbar navbar-fixed-top dv-navbar" role="navigation" aria-label="Navegación principal">
    <div class="container">
        <div class="navbar-header">
            <!--
              Custom hamburger toggle (replaces Bootstrap's data-toggle="collapse").
              State is owned by main.js; no Bootstrap collapse plugin involved.
              Aria state is kept in sync (aria-expanded) and the button controls
              the #dv-main-nav drawer below.
            -->
            <button type="button" class="dv-nav-toggle" id="dv-nav-toggle" aria-controls="dv-main-nav" aria-expanded="false" aria-label="Abrir menú de navegación">
                <!--
                  All inner content is non-interactive (pointer-events: none) so
                  `event.target` on a tap is always the <button> itself. Prevents
                  the case where a finger lands on the .sr-only or the bars and
                  the click target ends up being a child element.
                -->
                <span class="dv-nav-toggle__sr">Menú</span>
                <span class="dv-nav-toggle__bars" aria-hidden="true">
                    <span class="dv-nav-toggle__bar"></span>
                    <span class="dv-nav-toggle__bar"></span>
                    <span class="dv-nav-toggle__bar"></span>
                </span>
            </button>
            <a class="navbar-brand" href="index.php" aria-label="DATAVANT Systems — Inicio">
                <img src="assets/img/logo-icon.svg" alt="" class="brand-logo" aria-hidden="true">
                <span class="brand-text">DATAVANT <span>Systems</span></span>
            </a>
        </div>

        <!--
          Mobile drawer + desktop nav share this container.
          - Desktop (>=992px): rendered inline by Bootstrap 3 navbar styles.
          - Mobile  (<992px): styled as a fixed off-canvas panel; opened by
            toggling `body.dv-nav-open`. No Bootstrap `collapse` JS is used.
        -->
        <div class="navbar-collapse dv-nav-panel" id="dv-main-nav">
            <ul class="nav navbar-nav navbar-right" role="menubar">
                <li class="<?php echo ($current_page === 'inicio') ? 'active' : ''; ?>" role="none">
                    <a href="index.php" role="menuitem"<?php echo ($current_page === 'inicio') ? ' aria-current="page"' : ''; ?>>Inicio</a>
                </li>
                <li class="<?php echo ($current_page === 'servicios') ? 'active' : ''; ?>" role="none">
                    <a href="servicios.php" role="menuitem"<?php echo ($current_page === 'servicios') ? ' aria-current="page"' : ''; ?>>Servicios</a>
                </li>
                <li class="<?php echo ($current_page === 'proyectos') ? 'active' : ''; ?>" role="none">
                    <a href="proyectos.php" role="menuitem"<?php echo ($current_page === 'proyectos') ? ' aria-current="page"' : ''; ?>>Proyectos</a>
                </li>
                <li class="<?php echo ($current_page === 'nosotros') ? 'active' : ''; ?>" role="none">
                    <a href="nosotros.php" role="menuitem"<?php echo ($current_page === 'nosotros') ? ' aria-current="page"' : ''; ?>>Sobre mí</a>
                </li>
                <li class="<?php echo ($current_page === 'recursos') ? 'active' : ''; ?>" role="none">
                    <a href="recursos.php" role="menuitem"<?php echo ($current_page === 'recursos') ? ' aria-current="page"' : ''; ?>>Recursos</a>
                </li>
                <li class="nav-cta <?php echo ($current_page === 'contacto') ? 'active' : ''; ?>" role="none">
                    <a href="contacto.php" role="menuitem"<?php echo ($current_page === 'contacto') ? ' aria-current="page"' : ''; ?>>Contacto</a>
                </li>
            </ul>

            <!-- Theme toggle: fuera del <ul> para mantener semántica correcta. -->
            <div class="dv-theme-toggle-wrapper">
                <button type="button" class="dv-theme-toggle" id="dv-theme-switch" title="Cambiar tema" aria-label="Cambiar entre tema claro y oscuro" aria-pressed="false">
                    <span class="toggle-icon icon-dark" aria-hidden="true">&#9790;</span>
                    <span class="toggle-icon icon-light" aria-hidden="true">&#9788;</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Overlay for mobile drawer. Click closes the menu (handled in main.js). -->
    <div class="dv-nav-overlay" id="dv-nav-overlay" hidden></div>
</nav>
<main id="main-content" tabindex="-1">
