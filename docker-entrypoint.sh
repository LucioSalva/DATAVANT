#!/bin/bash

# ============================================
# DATAVANT Systems - Container Entrypoint
# Compiles SCSS if source files exist, then
# hands off to Apache.
# ============================================

SCSS_SRC="/var/www/html/assets/scss/main.scss"
CSS_OUT="/var/www/html/assets/css/main.css"

if command -v sass &> /dev/null && [ -f "$SCSS_SRC" ]; then
    echo "[entrypoint] Compiling SCSS -> CSS ..."
    if sass --no-source-map --style=compressed "$SCSS_SRC" "$CSS_OUT" 2>/dev/null; then
        echo "[entrypoint] SCSS compiled successfully: $CSS_OUT"
    else
        echo "[entrypoint] WARNING: SCSS compilation failed, using existing CSS."
    fi
else
    echo "[entrypoint] Skipping SCSS compilation (sass not found or source missing)."
fi

# Execute the CMD passed to the container (apache2-foreground)
exec "$@"
