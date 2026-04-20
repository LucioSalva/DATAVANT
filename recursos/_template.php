<?php
/**
 * Plantilla base para artículos de la sección «Recursos».
 *
 * Instrucciones de uso:
 *   1. Copia este archivo con un nombre en kebab-case descriptivo
 *      (por ejemplo: `optimizacion-consultas-sql.php`).
 *   2. Completa los metadatos del bloque superior (título, descripción, palabras clave).
 *   3. Reemplaza el contenido de las secciones marcadas con TODO.
 *   4. Conserva la estructura de `<section>` y `<article>` para mantener consistencia visual.
 *   5. Acentúa todas las palabras. Usa signos de apertura ¿? ¡!.
 *   6. Ejecuta `npm run lint:spell` antes de publicar.
 *   7. Agrega la tarjeta del artículo en `recursos.php` una vez publicado.
 *
 * No modifiques los includes de `head.php`, `header.php` ni `footer.php`.
 * No cambies los nombres de clases CSS (`dv-article`, `dv-article-title`, etc.).
 */

$current_page     = 'recursos';
$page_title       = 'TODO: Título del artículo | DATAVANT Systems';
$page_description = 'TODO: Descripción breve (150-160 caracteres) con las palabras clave más relevantes.';
$page_keywords    = 'TODO, palabras, clave, separadas, por, coma, datavant';

include __DIR__ . '/../includes/head.php';
include __DIR__ . '/../includes/header.php';
?>

<section class="section-padding bg-dark-section dv-article-header">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <nav class="dv-article-breadcrumb" aria-label="Ruta de navegación">
                    <a href="../recursos.php">Recursos</a>
                    <span aria-hidden="true">/</span>
                    <span>TODO: Categoría</span>
                </nav>
                <h1 class="dv-article-title dv-animate">TODO: Título del artículo</h1>
                <div class="dv-article-meta dv-animate dv-animate-delay-1">
                    <time datetime="2026-04-20">20 de abril de 2026</time>
                    <span aria-hidden="true">&middot;</span>
                    <span>TODO: Categoría</span>
                    <span aria-hidden="true">&middot;</span>
                    <span>TODO: X min de lectura</span>
                </div>
            </div>
        </div>
    </div>
</section>

<article class="dv-article">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 dv-article-body">

                <p class="dv-article-lead">TODO: Párrafo de entrada. Una o dos frases que expongan el problema o pregunta que resuelve el artículo. Conviene que enganche sin prometer de más.</p>

                <h2>TODO: Primer subtítulo</h2>
                <p>TODO: Cuerpo del primer apartado. Recuerda acentuar todas las palabras, cerrar signos de interrogación y exclamación con apertura (¿?, ¡!), y evitar anglicismos innecesarios.</p>

                <h2>TODO: Segundo subtítulo</h2>
                <p>TODO: Puedes incluir listas, bloques de código o citas. Usa las clases del sitio:</p>
                <ul class="dv-article-list">
                    <li>Lista desordenada con <code>class="dv-article-list"</code>.</li>
                    <li>Para código en línea usa la etiqueta <code>&lt;code&gt;</code>.</li>
                    <li>Para bloques de código usa <code>&lt;pre class="dv-article-code"&gt;</code>.</li>
                </ul>

<pre class="dv-article-code"><code>-- Ejemplo de bloque de código
SELECT columna
  FROM tabla
 WHERE condicion = true;</code></pre>

                <h2>TODO: Tercer subtítulo</h2>
                <p>TODO: Cierre del tema. Conviene aterrizar en una conclusión práctica o en el siguiente paso que el lector puede tomar.</p>

                <div class="dv-article-cta">
                    <h3>¿TODO: Pregunta de cierre que invite a contacto?</h3>
                    <p>TODO: Una o dos frases ofreciendo ayuda o continuación del tema.</p>
                    <a href="../contacto.php" class="btn-dv-primary">Contáctame</a>
                </div>

            </div>
        </div>
    </div>
</article>

<?php include __DIR__ . '/../includes/footer.php'; ?>
