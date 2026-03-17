<footer class="<?php echo $__env->yieldContent('header-class'); ?>">
    <div class="social-media">
        <ul>
            <li>
                <div class="h6 font-s-medium">Síguenos en</div>
            </li>
            <li>
                <a href="https://web.facebook.com/camcomercioSM/?_rdc=1&_rdr">
                    <img src="<?php echo e(asset('img/icons/facebook.svg')); ?>" alt="Facebook">
                </a>
            </li>
            <li>
                <a href="https://www.instagram.com/camcomerciosm/">
                    <img src="<?php echo e(asset('img/icons/instagram.svg')); ?>" alt="Instagram">
                </a>
            </li>
            <li>
                <a href="https://www.linkedin.com/company/camcomerciosm/mycompany/">
                    <img src="<?php echo e(asset('img/icons/linkedin.svg')); ?>" alt="linkedin">
                </a>
            </li>
            <li>
                <a href="https://twitter.com/i/flow/login?redirect_after_login=%2FCamComercioSM">
                    <img src="<?php echo e(asset('img/icons/twitter.svg')); ?>" alt="twitter">
                </a>
            </li>
            <li>
                <a href="https://www.youtube.com/CamaraComercioSantaMarta">
                    <img src="<?php echo e(asset('img/icons/youtube.svg')); ?>" alt="Youtube">
                </a>
            </li>
        </ul>
    </div>
    <div class="wrap wrap-medium">
        <div class="footer">
            <?php if(isset($footer->footer_logo_ally) && !empty($footer->footer_logo_ally)): ?>
                <a href="https://www.ccsm.org" target="_blank" aria-label="Camara de comercio (opens in a new tab)">
                    <img src="<?php echo e(asset('' . $footer->footer_logo_ally)); ?>" alt="Camara comercio">
                </a>
            <?php endif; ?>
            <?php if(isset($footer->footer_logo_rutac) && !empty($footer->footer_logo_rutac)): ?>
                <div class="logo">
                    <img src="<?php echo e(asset('' . $footer->footer_logo_rutac)); ?>" alt="Ruta C Logo footer">
                </div>
            <?php endif; ?>
            <div class="info">
                <ul>
                    <li class="textl">
                        <span class="font-s-small">Más información en</span>
                        <?php $whatsapp = optional($footer)->whatsapp ?? null; ?>
                        <?php if(!empty($whatsapp)): ?>
                            <span class="block font-s-small">
                                <a class="font-s-small"
                                   href="https://wa.me/<?php echo e($whatsapp); ?>?text=Me%20gustar%C3%ADa%20saber%20.........">
                                    <img src="<?php echo e(asset('img/icons/whatsapp.png')); ?>" alt="WhatsApp"
                                         style="max-width: 32px; float: left;" />
                                </a>
                                WhatsApp <?php echo e($whatsapp); ?>

                            </span>
                        <?php endif; ?>
                        <?php if(isset($footer->footer_ally_page) && !empty($footer->footer_ally_page)): ?>
                            <a class="font-s-small" href="https://<?php echo e($footer->footer_ally_page); ?>" target="_blank"
                                aria-label="<?php echo e($footer->footer_ally_page); ?> (opens in a new tab)"><?php echo e($footer->footer_ally_page); ?></a>
                        <?php endif; ?>
                        <?php if(isset($footer->footer_number_contact) && !empty($footer->footer_number_contact)): ?>
                            <span class="block font-s-small">Llámanos a <?php echo e($footer->footer_number_contact); ?></span>
                        <?php endif; ?>
                        <?php if(isset($footer->footer_email_contact) && !empty($footer->footer_email_contact)): ?>
                            <span class="block font-s-small">Escríbenos a <?php echo e($footer->footer_email_contact); ?></span>
                        <?php endif; ?>
                        <?php if(isset($footer->footer_address) && !empty($footer->footer_address)): ?>
                            <p class="font-s-small">Dirección: <?php echo e($footer->footer_address); ?><?php if(isset($footer->ubicacion_ciudad) && !empty($footer->ubicacion_ciudad)): ?>
                                    <br /><?php echo e($footer->ubicacion_ciudad); ?>

                                <?php endif; ?>
                            </p>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
        <div class="pp mt-40">
            <ul>
                <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($link->type == 0): ?>
                        <li>
                            <a class="font-s-small" href="<?php echo e($link->value); ?>" target="_blank"
                                aria-label="<?php echo e($link->name); ?> (opens in a new tab)"><?php echo e($link->name); ?></a>
                        </li>
                    <?php else: ?>
                        <li>
                            <a class="font-s-small" href="<?php echo e(asset('' . $link->value)); ?>" target="_blank"
                                aria-label="<?php echo e($link->name); ?> (opens in a new tab)"><?php echo e($link->name); ?></a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <li>
                    <a class="font-s-small" href="<?php echo e(route('site.map')); ?>" target="_blank"
                        aria-label="Mapa de sitio (opens in a new tab)">Mapa de sitio</a>
                </li>
            </ul>
        </div>
    </div>
</footer>



<div id="widget-whatsapp-raiz"></div>
<script>
    window.CONFIGURACION_WIDGET_WHATSAPP = {
        telefono: "573218150243",
        posicion: "izquierda-abajo",           // ver lista de posiciones más abajo
        textoBoton: "¿necesitas ayuda?",
        mensajePredeterminado: "Hola, necesito más informacion de.....",
        nombreMarca: "RutaC CamComercoSM",
        subtituloMarca: "Asesor Ruta C",
        textoBienvenida: "¡Hola! Cuéntanos en qué podemos apoyarte 😊",
        abrirAutomaticamente: false,
        imagenMarca: "https://cdnsicam.net/img/logo-2026-activa-tu-crecimiento.png",
        // cualquier campo que omitas usa el valor por defecto del widget
    };
</script>
<script src="https://cdnsicam.net/js/whatsapp-widget.js"></script>
<?php /**PATH C:\Users\jpllinas\Documents\DesarrolloWEB\VPS-RUTAC\APP\rutadecrecimiento\resources\views/website/layouts/footer.blade.php ENDPATH**/ ?>