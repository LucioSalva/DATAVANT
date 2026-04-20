# ============================================
# DATAVANT Systems - PHP + Apache + SCSS
# Production-ready single-stage build
# Runs as www-data (non-root) after setup.
# ============================================

FROM php:8.2-apache

LABEL maintainer="DATAVANT Systems"
LABEL description="PHP 8.2 + Apache corporate website with SCSS compilation"

# ----- System packages + Dart Sass -----
# curl is kept for the container healthcheck.
RUN apt-get update && apt-get install -y --no-install-recommends \
        libonig-dev \
        wget \
        curl \
        ca-certificates \
    && docker-php-ext-install mbstring \
    # Dart Sass (standalone linux-x64)
    && SASS_VERSION="1.77.4" \
    && wget -qO /tmp/sass.tar.gz \
       "https://github.com/sass/dart-sass/releases/download/${SASS_VERSION}/dart-sass-${SASS_VERSION}-linux-x64.tar.gz" \
    && tar -xzf /tmp/sass.tar.gz -C /opt \
    && ln -s /opt/dart-sass/sass /usr/local/bin/sass \
    && rm -rf /tmp/sass.tar.gz \
    && apt-get purge -y wget \
    && apt-get autoremove -y \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# ----- Apache configuration -----
# Apache binds on :80 in the official php:8.2-apache image; www-data has
# CAP_NET_BIND_SERVICE via the image so non-root :80 binding works.
RUN a2enmod rewrite headers \
    && sed -i 's|AllowOverride None|AllowOverride All|g' /etc/apache2/apache2.conf

# ----- SCSS entrypoint script -----
COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# ----- Copy application -----
COPY . /var/www/html/

# ----- Ensure logs dir + rate_limit store exist and are writable -----
RUN mkdir -p /var/www/html/logs \
    && touch /var/www/html/logs/rate_limit.json

# ----- File permissions -----
RUN chown -R www-data:www-data /var/www/html \
    && find /var/www/html -type d -exec chmod 755 {} \; \
    && find /var/www/html -type f -exec chmod 644 {} \; \
    && chmod 775 /var/www/html/logs \
    && chmod 664 /var/www/html/logs/rate_limit.json

# ----- Production PHP settings -----
RUN printf "display_errors = Off\ndisplay_startup_errors = Off\nlog_errors = On\nerror_log = /var/log/php_errors.log\nexpose_php = Off\n" \
    > /usr/local/etc/php/conf.d/production.ini

# ----- Healthcheck (aligned with docker-compose.yml) -----
HEALTHCHECK --interval=30s --timeout=5s --start-period=15s --retries=3 \
    CMD curl -fsS http://localhost/ >/dev/null || exit 1

EXPOSE 80

# ----- Drop to non-root (after chown, before CMD) -----
USER www-data

ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["apache2-foreground"]
