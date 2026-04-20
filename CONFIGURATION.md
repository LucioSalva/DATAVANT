# DATAVANT Systems — Configuration Guide

Guía breve para dejar el sitio operativo en un entorno nuevo (local, staging o producción).

Todo lo sensible vive en `.env` en la raíz del proyecto. Nunca se commitea. La plantilla es `.env.example`.

---

## 1. Variables obligatorias

| Variable            | Obligatoria | Descripción                                                                      |
|---------------------|-------------|----------------------------------------------------------------------------------|
| `APP_ENV`           | sí          | `development` o `production`.                                                    |
| `APP_URL_SCHEME`    | sí          | `http` local o `https` en producción (activa HSTS y cookies seguras).            |
| `SMTP_HOST`         | sí          | `smtp.gmail.com` para Gmail.                                                     |
| `SMTP_PORT`         | sí          | `587` con STARTTLS (recomendado) o `465` con SSL.                                |
| `SMTP_SECURE`       | sí          | `tls` para 587, `ssl` para 465.                                                  |
| `SMTP_USER`         | sí          | Correo Gmail que autentica (debe coincidir con el remitente real).               |
| `SMTP_PASS`         | sí          | App Password de 16 caracteres. **No** es la contraseña normal de Gmail.          |
| `SMTP_FROM_EMAIL`   | sí          | Dirección que aparece en el header `From:`. Gmail la fuerza a coincidir con user.|
| `SMTP_FROM_NAME`    | sí          | Nombre visible del remitente.                                                    |
| `CONTACT_TO_EMAIL`  | sí          | Buzón que recibe los mensajes del formulario.                                    |
| `LOG_IP_SALT`       | sí          | Hex de 64 caracteres para hashear IPs antes de loguearlas.                       |

Si alguna variable obligatoria está vacía, es un placeholder (`__ROTATE_ME__`, `__CHANGE_ME__`, etc.) o no es un email válido, el formulario queda deshabilitado automáticamente (fail-closed) y `send_mail.php` responde 503.

---

## 2. Generar un Gmail App Password

1. Activa verificación en dos pasos en la cuenta: <https://myaccount.google.com/security>.
2. Entra a <https://myaccount.google.com/apppasswords>.
3. Crea una contraseña de aplicación llamada, por ejemplo, `DATAVANT Web`.
4. Copia el string de 16 caracteres (puedes dejar o quitar los espacios) y pégalo como `SMTP_PASS` en `.env`.
5. Nunca la guardes en el repo, en Docker images ni en logs.

### Rotar la contraseña
1. Revoca la App Password comprometida desde la misma pantalla.
2. Genera una nueva.
3. Reemplaza el valor en `.env` y reinicia el servicio (`docker compose restart` o recargar PHP-FPM).
4. Verifica que `mail_is_configured()` devuelve `true` entrando a `/contacto.php`: si el banner de "formulario no operativo" desaparece, quedó rotada.

---

## 3. Generar `LOG_IP_SALT`

```bash
# Cualquiera de estos funciona:
openssl rand -hex 32
php -r "echo bin2hex(random_bytes(32)), PHP_EOL;"
python -c "import secrets; print(secrets.token_hex(32))"
```

Pega el resultado en `LOG_IP_SALT=`. Rotar este valor hace que los logs históricos queden de-identificados (los hashes ya no se pueden correlacionar con los nuevos).

---

## 4. Pasar a producción

1. En el servidor real:
   - `APP_ENV=production`
   - `APP_URL_SCHEME=https`
   - `SMTP_*` con credenciales reales y rotadas.
   - `CONTACT_TO_EMAIL` con el buzón real de destino.
   - `LOG_IP_SALT` distinto al de desarrollo.
2. Confirmar que el certificado TLS es válido (`curl -I https://tu-dominio/` sin warnings).
3. Renombrar `.htaccess.production` sobre `.htaccess` si vas a servir con Apache bare-metal, o dejar el `.htaccess` actual si estás detrás de un proxy que ya fuerza HTTPS.
4. Verificar que `/contacto.php` muestra el formulario activo (sin banner). Enviar un mensaje de prueba y confirmar que llega a `CONTACT_TO_EMAIL`.
5. Revisar `logs/events_YYYY-MM.log` para confirmar que quedó asentado `submit_success`.

---

## 5. Desarrollo local sin correo real

Si solo quieres levantar el sitio para ver UI/UX sin tocar credenciales:

1. Deja `.env` con `SMTP_PASS=__ROTATE_ME__` y `CONTACT_TO_EMAIL=` vacío.
2. `/contacto.php` se renderizará con el banner "formulario temporalmente no operativo" y el botón deshabilitado. Es el comportamiento esperado.
3. Para probar el flujo de envío, pon credenciales reales temporales en `.env` (nunca commitear) y reinicia el proceso PHP.

---

## 6. Checklist rápido antes de desplegar

- [ ] `.env` existe, con todas las variables obligatorias llenas y sin placeholders `__...__`.
- [ ] `APP_URL_SCHEME=https` en producción.
- [ ] `CONTACT_TO_EMAIL` válido y distinto del buzón spam.
- [ ] `LOG_IP_SALT` único por entorno, 64 hex chars.
- [ ] Compile CSS: `npx -y sass assets/scss/main.scss assets/css/main.css --no-source-map --style=expanded`.
- [ ] `/contacto.php` muestra formulario activo.
- [ ] Envío de prueba recibido en `CONTACT_TO_EMAIL`.
- [ ] `robots.txt` y `sitemap.xml` apuntan al dominio real.
- [ ] Logs rotan correctamente y contienen hashes, no IPs crudas.
