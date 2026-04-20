<?php
require_once __DIR__ . '/includes/bootstrap.php';

$current_page     = 'aviso-privacidad';
$page_title       = 'Aviso de Privacidad | DATAVANT Systems';
$page_description = 'Aviso de privacidad integral de DATAVANT Systems conforme a la Ley Federal de Protección de Datos Personales en Posesión de los Particulares (México).';

$contact_email = getenv('CONTACT_TO_EMAIL');
if (!is_string($contact_email) || $contact_email === '') {
    $contact_email = getenv('SMTP_USER') ?: 'lucio.s.isc@gmail.com';
}
$contact_email_safe = htmlspecialchars($contact_email, ENT_QUOTES, 'UTF-8');

$last_updated = '14 de abril de 2026';

include __DIR__ . '/includes/head.php';
include __DIR__ . '/includes/header.php';
?>

<section class="section-padding bg-dark-section dv-legal-header">
    <div class="container">
        <div class="section-title dv-animate">
            <h1>Aviso de Privacidad</h1>
            <span class="title-accent"></span>
            <p>Última actualización: <?php echo htmlspecialchars($last_updated, ENT_QUOTES, 'UTF-8'); ?>.</p>
        </div>
    </div>
</section>

<section class="bg-black-section section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <article class="dv-legal">

                    <h2>1. Responsable del tratamiento</h2>
                    <p>
                        Soy <strong>Ing. Humberto Salvador Ruiz Lucio</strong>, quien opera bajo la marca
                        <strong>DATAVANT Systems</strong>. Soy responsable del tratamiento de los datos personales
                        que recabo a través de este sitio. Para cualquier asunto relacionado con este aviso, puedes
                        contactarme en
                        <a href="mailto:<?php echo $contact_email_safe; ?>"><?php echo $contact_email_safe; ?></a>.
                    </p>

                    <h2>2. Datos personales que recabo</h2>
                    <p>A través del formulario de contacto de este sitio recabo únicamente los siguientes datos:</p>
                    <ul>
                        <li>Nombre.</li>
                        <li>Correo electrónico.</li>
                        <li>Teléfono (opcional).</li>
                        <li>Asunto y contenido del mensaje que decidas enviarme.</li>
                    </ul>
                    <p>
                        De manera automática, y con fines estrictamente de seguridad y prevención de abuso, el
                        servidor registra una versión <em>hasheada</em> (no reversible) de la dirección IP desde la
                        que se envía el formulario. No almaceno la IP en texto plano ni asocio ese hash con tu nombre
                        o correo.
                    </p>

                    <h2>3. Finalidades del tratamiento</h2>
                    <p>Los datos que me proporcionas se utilizan exclusivamente para:</p>
                    <ul>
                        <li>Responder tu solicitud, duda o propuesta de proyecto.</li>
                        <li>Dar seguimiento a la conversación que inicies conmigo.</li>
                        <li>Elaborar, cuando corresponda, una cotización o propuesta técnica.</li>
                        <li>Prevenir envíos automatizados, fraude o abuso del formulario (seguridad).</li>
                    </ul>
                    <p>No utilizo tus datos para publicidad, <em>profiling</em> ni toma de decisiones automatizadas.</p>

                    <h2>4. Fundamento legal</h2>
                    <p>
                        El tratamiento se realiza conforme a la <strong>Ley Federal de Protección de Datos Personales
                        en Posesión de los Particulares (LFPDPPP)</strong> de México, su Reglamento y los Lineamientos
                        del Aviso de Privacidad. La base legal es tu consentimiento expreso, otorgado al aceptar este
                        aviso antes de enviar el formulario.
                    </p>

                    <h2>5. Transferencias</h2>
                    <p>
                        <strong>No transfiero tus datos personales a terceros.</strong> El formulario se procesa en
                        mi infraestructura y el correo resultante se entrega a una cuenta de correo bajo mi control.
                        Los proveedores técnicos que intervienen en el envío (servidor de correo, proveedor de
                        hospedaje) actúan como encargados y únicamente acceden a los datos en la medida estrictamente
                        necesaria para prestar el servicio.
                    </p>

                    <h2>6. Conservación</h2>
                    <p>
                        Conservo los mensajes recibidos y los registros técnicos asociados (bitácoras) por un
                        periodo máximo de <strong>12 meses</strong>, contados a partir de la recepción del mensaje.
                        Transcurrido ese plazo, los elimino de forma periódica, salvo que exista una obligación legal
                        o una relación comercial activa contigo que justifique una conservación adicional.
                    </p>

                    <h2>7. Derechos ARCO</h2>
                    <p>En todo momento tienes derecho a:</p>
                    <ul>
                        <li><strong>Acceder</strong> a los datos personales que tengo sobre ti.</li>
                        <li><strong>Rectificar</strong> datos inexactos o incompletos.</li>
                        <li><strong>Cancelar</strong> el tratamiento cuando consideres que no se requiere para las finalidades señaladas.</li>
                        <li><strong>Oponerte</strong> al tratamiento para fines específicos.</li>
                    </ul>
                    <p>
                        Para ejercer cualquiera de estos derechos envía un correo a
                        <a href="mailto:<?php echo $contact_email_safe; ?>"><?php echo $contact_email_safe; ?></a>
                        indicando: tu nombre completo, el derecho que deseas ejercer, una descripción clara de la
                        solicitud y un medio de contacto para responderte. Atenderé tu solicitud en un plazo máximo
                        de 20 días hábiles conforme al artículo 32 de la LFPDPPP.
                    </p>

                    <h2>8. Revocación del consentimiento</h2>
                    <p>
                        Puedes revocar tu consentimiento en cualquier momento enviando un correo a
                        <a href="mailto:<?php echo $contact_email_safe; ?>"><?php echo $contact_email_safe; ?></a>
                        con el asunto <em>&ldquo;Revocación de consentimiento&rdquo;</em>. Una vez recibida la
                        solicitud, procederé a eliminar tus datos del sistema, salvo aquellos que deba conservar
                        por obligación legal.
                    </p>

                    <h2>9. Medidas de seguridad</h2>
                    <p>
                        He adoptado medidas de seguridad administrativas, técnicas y físicas razonables para proteger
                        tus datos personales contra daño, pérdida, alteración, destrucción o uso no autorizado. Entre
                        otras: cifrado del canal SMTP, tokens CSRF en el formulario, limitación de envíos por IP,
                        <em>hash</em> de direcciones IP en bitácora y acceso restringido a los sistemas donde se
                        almacenan los mensajes.
                    </p>

                    <h2>10. Cookies y tecnologías similares</h2>
                    <p>
                        Este sitio utiliza únicamente almacenamiento local del navegador
                        (<code>localStorage</code>) para recordar tu preferencia de tema (claro u oscuro). No utilizo
                        cookies de seguimiento, cookies publicitarias ni herramientas de analítica de terceros.
                        La sesión PHP se establece solo cuando envías el formulario de contacto, vive como cookie
                        de sesión técnica y se invalida al cerrar el navegador.
                    </p>

                    <h2>11. Cambios al aviso</h2>
                    <p>
                        Cualquier modificación a este aviso de privacidad será publicada en esta misma página,
                        indicando la fecha de la última actualización al inicio del documento. Te recomiendo
                        revisarlo periódicamente.
                    </p>

                    <h2>12. Contacto</h2>
                    <p>
                        Para cualquier duda, aclaración o ejercicio de derechos:
                        <a href="mailto:<?php echo $contact_email_safe; ?>"><?php echo $contact_email_safe; ?></a>.
                    </p>

                </article>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
