<?php
$current_page     = 'recursos';
$page_title       = 'Por qué tu consulta PostgreSQL es lenta aunque tengas un índice | DATAVANT Systems';
$page_description = 'Casos reales donde el optimizer de PostgreSQL ignora un índice: orden de columnas, funciones en el WHERE, predicados no sargables e índices parciales mal diseñados.';
$page_keywords    = 'postgresql, índices, explain analyze, optimización, consultas lentas, sargable, datavant';
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
                    <span>Bases de datos</span>
                </nav>
                <h1 class="dv-article-title dv-animate">Por qué tu consulta PostgreSQL es lenta aunque tengas un índice</h1>
                <div class="dv-article-meta dv-animate dv-animate-delay-1">
                    <time datetime="2026-04-16">16 de abril de 2026</time>
                    <span aria-hidden="true">&middot;</span>
                    <span>Bases de datos</span>
                    <span aria-hidden="true">&middot;</span>
                    <span>7 min de lectura</span>
                </div>
            </div>
        </div>
    </div>
</section>

<article class="dv-article">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 dv-article-body">

                <p class="dv-article-lead">Recibo esta consulta al menos una vez al mes: <em>&laquo;ya creamos el índice pero la consulta sigue lenta&raquo;</em>. La respuesta corta es que un índice no garantiza que se use. La respuesta larga se divide en cuatro situaciones que veo casi siempre y que vale la pena identificar antes de tocar más el esquema.</p>

                <h2>El optimizer decide, no el que crea el índice</h2>
                <p>PostgreSQL no usa un índice porque exista, sino porque el planeador estima que leer el índice y después la tabla es más barato que un <em>sequential scan</em>. Cuando la tabla es pequeña, cuando las estadísticas están desactualizadas o cuando el predicado no es &laquo;sargable&raquo;, el planeador prefiere leer toda la tabla. No es un bug: es exactamente lo que se le pidió.</p>
                <p>La herramienta para entender qué pasa es <code>EXPLAIN (ANALYZE, BUFFERS)</code>. No <code>EXPLAIN</code> a secas: el plan estimado puede ser muy distinto al real, y sin <code>BUFFERS</code> no sabes si estás leyendo de caché o de disco. Guarda siempre los dos planes (con y sin el cambio) antes de concluir que el índice ayuda o no.</p>

                <h2>Caso 1: el orden de columnas importa</h2>
                <p>Un índice compuesto <code>CREATE INDEX ON pedidos(cliente_id, fecha)</code> sirve perfecto para filtros <code>WHERE cliente_id = ?</code> o <code>WHERE cliente_id = ? AND fecha &gt; ?</code>. Pero <strong>no</strong> sirve solo para <code>WHERE fecha &gt; ?</code>. Es el equivalente a un diccionario ordenado por apellido y luego por nombre: sirve para buscar &laquo;López, Mario&raquo;, no para buscar &laquo;todos los Marios&raquo;.</p>
                <p>La regla práctica es sencilla: la primera columna del índice debe ser la que filtra de forma más selectiva, o la que aparece en todas las consultas que importan. Si tienes un índice <code>(fecha, cliente_id)</code> y tu consulta siempre filtra primero por cliente, probablemente estás pagando mantenimiento del índice y ganando nada.</p>

                <h2>Caso 2: funciones en el WHERE inutilizan el índice</h2>
                <p>Un filtro como <code>WHERE lower(email) = 'alguien@dominio.com'</code> sobre un índice <code>CREATE INDEX ON usuarios(email)</code> no se usa. El índice tiene los valores originales; la función <code>lower()</code> obliga a evaluar cada fila. Lo mismo pasa con <code>WHERE fecha::date = '2026-04-10'</code> sobre una columna <code>timestamp</code>, con <code>WHERE substring(rfc, 1, 4) = ?</code> o con casts implícitos por comparar tipos distintos.</p>
                <p>La corrección tiene dos caminos:</p>
                <ul class="dv-article-list">
                    <li><strong>Normalizar al guardar</strong>, de modo que el dato ya venga en minúsculas o sin la parte irrelevante. Es la opción más limpia si el dato se consulta siempre del mismo modo.</li>
                    <li><strong>Crear un índice funcional</strong>: <code>CREATE INDEX ON usuarios(lower(email))</code>. El índice guarda la expresión evaluada y el planeador lo reconoce cuando escribes exactamente la misma función en el WHERE. Tiene costo de mantenimiento extra, pero funciona.</li>
                </ul>

                <h2>Caso 3: índices parciales para predicados recurrentes</h2>
                <p>Cuando una tabla acumula millones de filas pero el 95 % de las consultas solo mira las activas, un índice completo sobre <code>estado</code> no aporta mucho. Un índice parcial sí:</p>
<pre class="dv-article-code"><code>CREATE INDEX pedidos_activos_fecha_idx
    ON pedidos (fecha)
    WHERE estado = 'activo';</code></pre>
                <p>El índice ocupa una fracción del espacio (solo indexa las filas activas), el mantenimiento por INSERT/UPDATE sobre pedidos cerrados es gratis y el planeador lo usa automáticamente cuando el WHERE contiene el mismo predicado. Funciona perfecto para dashboards operativos, bandejas de revisión o colas de trabajo.</p>

                <h2>Caso 4: estadísticas desactualizadas</h2>
                <p>PostgreSQL decide el plan con base en <code>pg_stats</code>. Después de una carga masiva (import de CSV, migración, etc.) las estadísticas pueden quedar muy desfasadas y el planeador subestimar o sobreestimar filas. La consecuencia clásica: el plan prefiere un <em>sequential scan</em> sobre una tabla grande porque cree que tiene 500 filas cuando tiene 5 millones.</p>
                <p>La curación es trivial y la olvido a menudo: <code>ANALYZE pedidos;</code> después de una carga grande, o una política de <code>autovacuum</code> más agresiva en tablas que cambian mucho. Si el problema aparece solo después de importar datos y desaparece a las horas, son las estadísticas.</p>

                <h2>Qué hago yo cuando llega esta consulta</h2>
                <ol class="dv-article-list">
                    <li>Correr <code>EXPLAIN (ANALYZE, BUFFERS)</code> sobre la consulta lenta y guardar el plan.</li>
                    <li>Verificar si realmente se usa el índice que se cree que se usa. Muchas veces la respuesta es no.</li>
                    <li>Si no se usa, revisar las cuatro causas anteriores en ese orden: orden de columnas, funciones en el WHERE, predicado parcial y estadísticas.</li>
                    <li>Si se usa pero sigue lento, mirar <code>Rows Removed by Filter</code> y <code>Buffers</code>: suele apuntar a que el índice trae muchas filas y la tabla tiene que filtrar después. Ahí conviene replantear el índice para que sea más selectivo.</li>
                    <li>Solo al final, pensar en reescribir la consulta o reordenar JOINs. La mayoría de las veces no hace falta.</li>
                </ol>

                <p>El patrón de fondo: antes de agregar índices, entender por qué el existente no se está usando. Agregar índices &laquo;por si acaso&raquo; hace crecer el mantenimiento de escritura y rara vez resuelve el problema real.</p>

                <div class="dv-article-cta">
                    <h3>¿Tienes una consulta lenta que no encuentra salida?</h3>
                    <p>Si ya probaste los cuatro casos y sigues sin entender el plan, escríbeme. Lo miro contigo y te digo honestamente si es algo que se arregla con un índice o si el problema es estructural.</p>
                    <a href="../contacto.php" class="btn-dv-primary">Contáctame</a>
                </div>

            </div>
        </div>
    </div>
</article>

<?php include __DIR__ . '/../includes/footer.php'; ?>
