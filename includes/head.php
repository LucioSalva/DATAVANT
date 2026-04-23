<?php
/**
 * DATAVANT Systems - Head Include
 * Meta tags, CSS, fonts, early theme detection (CSP-clean: no inline JS).
 *
 * Variables expected (all optional, sane defaults applied):
 *   $page_title, $page_description, $page_keywords, $current_page
 */

// --- Default page meta ---
$page_title       = isset($page_title) ? $page_title : 'DATAVANT Systems | Soluciones Tecnológicas Profesionales';
$page_description = isset($page_description) ? $page_description : 'DATAVANT Systems ofrece desarrollo web, bases de datos, automatización, soporte técnico e infraestructura tecnológica para empresas que buscan resultados reales.';
$page_keywords    = isset($page_keywords) ? $page_keywords : 'desarrollo web, bases de datos, automatización, soporte técnico, consultoría tecnológica, DATAVANT Systems';
$current_page     = isset($current_page) ? $current_page : 'inicio';

// --- Canonical URL (APP_URL_SCHEME + host + current URI) ---
$dv_scheme = getenv('APP_URL_SCHEME');
if (!is_string($dv_scheme) || ($dv_scheme !== 'http' && $dv_scheme !== 'https')) {
    $dv_scheme = 'https';
}
$dv_host = isset($_SERVER['HTTP_HOST']) && is_string($_SERVER['HTTP_HOST'])
    ? $_SERVER['HTTP_HOST']
    : 'datavant.systems';
$dv_uri  = isset($_SERVER['REQUEST_URI']) && is_string($_SERVER['REQUEST_URI'])
    ? strtok($_SERVER['REQUEST_URI'], '?')
    : '/';
$dv_canonical = $dv_scheme . '://' . $dv_host . $dv_uri;

// --- OG image: absolute URL for crawlers ---
// Real 1200x630 JPEG generated via .claude/scripts/generate_brand_assets.py.
$dv_og_image = $dv_scheme . '://' . $dv_host . '/assets/img/og-image.jpg';

// --- Asset cache-busting ---
// Append `?v=<filemtime>` to every local CSS/JS so browsers re-fetch
// automatically whenever the file changes on disk. Skips Google Fonts
// and other external URLs. Falls back to the current request time if
// filemtime fails (e.g., during a deploy race).
$dv_asset_root = __DIR__ . '/..';
$dv_asset_v = function (string $relative_path) use ($dv_asset_root): string {
    $full = $dv_asset_root . '/' . ltrim($relative_path, '/');
    $mtime = @filemtime($full);
    return (string) ($mtime !== false ? $mtime : time());
};

$dv_v_theme_init  = $dv_asset_v('assets/js/theme-init.js');
$dv_v_bootstrap_css = $dv_asset_v('assets/css/bootstrap.min.css');
$dv_v_main_css    = $dv_asset_v('assets/css/main.css');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#0A0A0A">

    <!-- SEO -->
    <title><?php echo htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8'); ?></title>
    <meta name="description" content="<?php echo htmlspecialchars($page_description, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="keywords" content="<?php echo htmlspecialchars($page_keywords, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="author" content="DATAVANT Systems">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="<?php echo htmlspecialchars($dv_canonical, ENT_QUOTES, 'UTF-8'); ?>">

    <!-- Open Graph -->
    <meta property="og:title" content="<?php echo htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:description" content="<?php echo htmlspecialchars($page_description, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?php echo htmlspecialchars($dv_canonical, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:site_name" content="DATAVANT Systems">
    <meta property="og:locale" content="es_MX">
    <meta property="og:image" content="<?php echo htmlspecialchars($dv_og_image, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:image:secure_url" content="<?php echo htmlspecialchars($dv_og_image, ENT_QUOTES, 'UTF-8'); ?>">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="DATAVANT Systems — Soluciones tecnológicas: desarrollo, datos, automatización, infraestructura.">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="twitter:description" content="<?php echo htmlspecialchars($page_description, ENT_QUOTES, 'UTF-8'); ?>">
    <meta name="twitter:image" content="<?php echo htmlspecialchars($dv_og_image, ENT_QUOTES, 'UTF-8'); ?>">

    <!-- Favicons -->
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="icon" type="image/svg+xml" href="assets/img/favicon.svg">
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">

    <!-- Early theme detection (CSP-clean, avoids FOUC) -->
    <script src="assets/js/theme-init.js?v=<?php echo $dv_v_theme_init; ?>"></script>

    <!-- Google Fonts: Ubuntu -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <!-- Bootstrap 3.4.1 (local) -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css?v=<?php echo $dv_v_bootstrap_css; ?>">

    <!-- DATAVANT Custom Styles (compiled from assets/scss/main.scss) -->
    <!-- Tokens + themes live inside this single file; no separate override layer. -->
    <link rel="stylesheet" href="assets/css/main.css?v=<?php echo $dv_v_main_css; ?>">

<?php if ($current_page === 'inicio'): ?>
    <!-- JSON-LD: Organization (solo en home). Estático, permitido por CSP ('self' aplica a scripts externos; los application/ld+json no ejecutan JS). -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "DATAVANT Systems",
      "url": "<?php echo htmlspecialchars($dv_scheme . '://' . $dv_host . '/', ENT_QUOTES, 'UTF-8'); ?>",
      "logo": "<?php echo htmlspecialchars($dv_scheme . '://' . $dv_host . '/assets/img/logo-icon.svg', ENT_QUOTES, 'UTF-8'); ?>",
      "description": "Desarrollo web, bases de datos, automatización e infraestructura tecnológica a medida para empresas en México.",
      "founder": {
        "@type": "Person",
        "name": "Humberto Salvador Ruiz Lucio",
        "jobTitle": "Fundador y Director Técnico"
      },
      "address": {
        "@type": "PostalAddress",
        "addressCountry": "MX"
      },
      "contactPoint": {
        "@type": "ContactPoint",
        "contactType": "customer support",
        "email": "lucio.s.isc@gmail.com",
        "telephone": "+52-56-2111-1752",
        "areaServed": "MX",
        "availableLanguage": ["es"]
      },
      "sameAs": [
        "https://www.linkedin.com/in/luciosalck/",
        "https://github.com/LucioSalva"
      ]
    }
    </script>
<?php endif; ?>
</head>
<body>
<!-- Skip to content (accessibility) -->
<a href="#main-content" class="dv-skip-link">Saltar al contenido</a>
