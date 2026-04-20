<?php
$current_page     = 'recursos';
$page_title       = 'Armando un homelab con Docker para desarrollo serio sin gastar en la nube | DATAVANT Systems';
$page_description = 'Cómo armar un homelab con Docker Compose en una PC vieja: PostgreSQL persistente, red interna, proxy reverso simple y buenas prácticas de volúmenes y backups.';
$page_keywords    = 'docker, homelab, docker-compose, postgresql, nginx, proxy reverso, desarrollo, DATAVANT';
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
                    <span>Infraestructura</span>
                </nav>
                <h1 class="dv-article-title dv-animate">Armando un homelab con Docker para desarrollo serio sin gastar en la nube</h1>
                <div class="dv-article-meta dv-animate dv-animate-delay-1">
                    <time datetime="2026-04-16">16 de abril de 2026</time>
                    <span aria-hidden="true">&middot;</span>
                    <span>Infraestructura</span>
                    <span aria-hidden="true">&middot;</span>
                    <span>8 min de lectura</span>
                </div>
            </div>
        </div>
    </div>
</section>

<article class="dv-article">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1 dv-article-body">

                <p class="dv-article-lead">Durante años pagué instancias en la nube para cosas que cabían de sobra en una PC vieja: una base de datos personal, un sitio staging, un runner de scripts nocturnos. Hoy todo eso corre en casa sobre un equipo de hace cinco años, con Docker Compose y una red interna. Cuesta literalmente lo que cuesta la luz. Te cuento cómo lo armo.</p>

                <h2>Hardware: lo que ya tienes probablemente alcanza</h2>
                <p>Mi homelab actual es una laptop Dell i5 de 2019 con 16 GB de RAM, SSD de 512 GB y Ubuntu Server minimal. No tiene pantalla conectada, vive en una esquina, la administro por SSH. No tienes que comprar nada nuevo: cualquier equipo con 8 GB de RAM y SSD aguanta tres o cuatro servicios y una base de datos pequeña sin sudar. La regla dura es no usar disco mecánico para bases de datos; el resto no importa.</p>

                <h2>Principio: un compose file por stack, no uno para todo</h2>
                <p>El error inicial es querer meter todos los servicios en un solo <code>docker-compose.yml</code>. Escala mal. Prefiero un directorio por stack independiente, con su propio compose:</p>
<pre class="dv-article-code"><code>~/homelab/
  postgres/        docker-compose.yml + data
  web-datavant/    docker-compose.yml + código
  scripts/         docker-compose.yml (cron jobs)
  proxy/           docker-compose.yml (nginx o caddy)</code></pre>
                <p>Cada stack se levanta y se apaga independiente. Si un servicio se rompe, los otros no se enteran. Para comunicarlos uso una red Docker externa compartida; ahí el proxy se conecta a cualquiera.</p>

                <h2>PostgreSQL persistente bien hecho</h2>
                <p>Un PostgreSQL serio con volumen nombrado, healthcheck y límite de recursos:</p>
<pre class="dv-article-code"><code>services:
  db:
    image: postgres:16-alpine
    restart: unless-stopped
    environment:
      POSTGRES_USER: dv
      POSTGRES_PASSWORD_FILE: /run/secrets/pg_pass
      POSTGRES_DB: dv_main
    volumes:
      - pgdata:/var/lib/postgresql/data
    healthcheck:
      test: ["CMD-SHELL", "pg_isready -U dv -d dv_main"]
      interval: 10s
      timeout: 5s
      retries: 5
    secrets:
      - pg_pass
    networks:
      - homelab
volumes:
  pgdata:
secrets:
  pg_pass:
    file: ./secrets/pg_pass.txt
networks:
  homelab:
    external: true</code></pre>
                <p>Tres detalles que evitan dolores:</p>
                <ul class="dv-article-list">
                    <li><strong>Volumen nombrado</strong>, no bind mount. Los bind mounts sobre <code>/var/lib/postgresql/data</code> tienen permisos distintos según el host y fallan al reiniciar.</li>
                    <li><strong>Healthcheck real</strong>, no solo <code>sleep</code>. Permite que otros contenedores con <code>depends_on: condition: service_healthy</code> esperen a que la base esté lista.</li>
                    <li><strong>Secreto en archivo</strong>, no en variable <code>POSTGRES_PASSWORD</code>. La variable queda visible con <code>docker inspect</code>.</li>
                </ul>

                <h2>Red interna: una sola, externa, compartida</h2>
                <p>Declaro una red una vez a mano:</p>
<pre class="dv-article-code"><code>docker network create homelab</code></pre>
                <p>Y todos los stacks la declaran como externa. De ese modo el proxy del stack <code>proxy/</code> puede resolver a <code>db</code> del stack <code>postgres/</code> por DNS interno, sin abrir puertos en el host. Esta es la diferencia entre un homelab ordenado y un spaghetti: el 95 % de los servicios no necesita exponer puertos al host. Solo el proxy lo hace.</p>

                <h2>Proxy reverso: Caddy o Nginx, depende del caso</h2>
                <p>Para desarrollo personal en LAN uso Caddy porque me ahorra certificados: genera TLS solo si lo apuntas a un dominio real. Para staging que quiero que se parezca más a producción uso Nginx, porque es el mismo motor que tengo después en el servidor. La configuración mínima de Nginx para servir mi stack PHP es:</p>
<pre class="dv-article-code"><code>upstream app {
  server web-datavant:80;
}
server {
  listen 80;
  server_name datavant.local;
  location / {
    proxy_pass http://app;
    proxy_set_header Host $host;
    proxy_set_header X-Forwarded-For $remote_addr;
    proxy_set_header X-Forwarded-Proto $scheme;
  }
}</code></pre>
                <p>Entrada <code>127.0.0.1 datavant.local</code> en <code>/etc/hosts</code> y ya puedo navegar al sitio por nombre, exactamente como lo haré en producción. Eso detecta problemas de <code>Host</code> y redirects que en <code>localhost:8080</code> no se veían.</p>

                <h2>Respaldos: el día que se necesita es el día que no se tiene</h2>
                <p>Un script sencillo en cron local que hace <code>pg_dump</code> a las 3 AM y lo guarda comprimido en un disco externo:</p>
<pre class="dv-article-code"><code>#!/bin/bash
TS=$(date +%F)
docker exec postgres_db_1 pg_dump -U dv dv_main | gzip > /mnt/backup/dv_main_$TS.sql.gz
find /mnt/backup -name 'dv_main_*.sql.gz' -mtime +14 -delete</code></pre>
                <p>Mantiene los últimos 14 días, descarta el resto. Cada dos semanas copio manualmente una versión al almacenamiento de larga duración (OneDrive personal encriptado). Es suficiente para lo que hago. Para cosas serias, que apunten a fuera del mismo disco físico.</p>

                <h2>Observabilidad mínima</h2>
                <p>No corro Prometheus ni Grafana en el homelab. Para lo que hago alcanza con:</p>
                <ul class="dv-article-list">
                    <li><code>docker stats</code> en vivo cuando algo se siente lento.</li>
                    <li><code>docker compose logs -f</code> y <code>docker logs --since 1h</code> para caza de errores.</li>
                    <li><code>ctop</code> (un top para contenedores) si necesito una vista global.</li>
                </ul>
                <p>Las herramientas pesadas las agrego cuando el problema justifica la complejidad, no antes.</p>

                <h2>Qué resuelvo con esto</h2>
                <p>Con ese setup tengo PostgreSQL siempre arriba, un sitio staging que reproduce el comportamiento de producción, un lugar para correr scripts batch sin ensuciar mi máquina de trabajo, y un laboratorio donde probar actualizaciones de dependencias antes de aplicarlas en serio. Todo sin factura mensual y con backups reales.</p>
                <p>Lo que no resuelve: alta disponibilidad, tráfico público real o datos sensibles de terceros. Para eso sigo pagando un servidor gestionado. Pero para el 80 % de lo que necesita un desarrollador individual, el homelab alcanza y sobra.</p>

                <div class="dv-article-cta">
                    <h3>¿Quieres que te ayude a armar tu propio homelab?</h3>
                    <p>Si tienes un equipo viejo guardado y no sabes por dónde empezar, puedo ayudarte a definir el stack mínimo que te sirve. Escríbeme y lo revisamos.</p>
                    <a href="../contacto.php" class="btn-dv-primary">Contáctame</a>
                </div>

            </div>
        </div>
    </div>
</article>

<?php include __DIR__ . '/../includes/footer.php'; ?>
