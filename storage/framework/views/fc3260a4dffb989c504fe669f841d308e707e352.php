
<?php $__env->startSection('header-class', 'without-header'); ?>
<?php $__env->startSection('title', 'Ruta C'); ?>
<?php $__env->startSection('description', ''); ?>
<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('website.company.aviso_validaciondatos', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <form id="preguntas_diagnostico_programa" method="post" action="<?php echo e(route('company.application.save')); ?>">
        <input type="hidden" name="program" value="<?php echo e($program->convocatoria_id); ?>" />
        <?php echo csrf_field(); ?>
        <div id="diagnostic">
            <div class="wrap">
                <?php if(count($variables) > 0): ?>

                    <?php if($volverApreguntar): ?>
                        <section id="step-1">
                            <h1 class="size-l color-2 font-w-700">Gracias por su participación en el programa
                                <?php echo e($program->nombre); ?></h1>
                            <p class="mt-5">A continuación lo invitamos a completar algunas preguntas de profundización.
                            </p>
                            <button type="button" id="start-proccess"
                                class="button button-primary button-small mt-20 margin-center">Iniciar preguntas</button>
                        </section>
                    <?php else: ?>
                        <section id="step-1">
                            <h1 class="size-l color-2 font-w-700">Proceso de solicitud <?php echo e($program->nombre); ?></h1>
                            <p class="mt-5">A continuación debera completar algunas preguntas de profundización para poder
                                aplicar al programa</p>
                            <button type="button" id="start-proccess"
                                class="button button-primary button-small mt-20 margin-center">Iniciar preguntas</button>
                            <a class="button button-third button-small mt-10 margin-center"
                                href="<?php echo e(route('company.program.show', [$program->convocatoria_id])); ?>">Cancelar proceso</a>
                        </section>
                    <?php endif; ?>

                    <?php $__currentLoopData = $variables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variable): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <section id="variable-<?php echo e($variable->requisito_id); ?>" class="variable hidden">
                            <h2 class="color-2 font-w-700"><?php echo e($variable->requisito_titulo); ?></h2>
                            <div class="fw-bold_" style="font-size: 75%;color: grey;">_<?php echo e($variable->requisito_ayuda); ?>

                            </div>

                            <?php if($variable->preguntatipo_id == 1): ?>
                                <ul style="padding:0">
                                    <?php $__currentLoopData = $variable->opciones()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <label class="radio">
                                                <input type="radio" name="variable-<?php echo e($variable->requisito_id); ?>"
                                                    value="<?php echo e($item->opcionrequisito_id); ?>" />
                                                <div class="info font-w-500">
                                                    <?php echo e($item->opcion_variable_response); ?>

                                                </div>
                                            </label>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            <?php elseif($variable->preguntatipo_id == 2): ?>
                                <input class="mt-10 textc input-numero" type="text" placeholder="Ingrese un valor"
                                    name="variable-<?php echo e($variable->requisito_id); ?>" data-raw="" required
                                    inputmode="numeric" />
                            <?php else: ?>
                            <?php endif; ?>

                            <button type="button" class="button button-primary mt-20 button-next">Continuar</button>
                            <button type="button" class="button button-secundary mt-10 button-back">Regresar</button>

                        </section>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </div>
    </form>

    <?php if(count($variables) > 0): ?>
        <script>
            $(document).ready(function() {
                $('#start-proccess').click(function() {
                    $("#step-1").slideUp();
                    $("#variable-<?php echo e($variables->first()->requisito_id); ?>").slideDown();
                });

                $('.button-next').click(function() {
                    $variable = $(this).parent().attr('id');
                    let valor = $("#" + $variable).find('input[name=' + $variable + ']');
                    let seleccionado = false;

                    if (valor.is('input[type="radio"]')) {
                        seleccionado = valor.filter(':checked').length > 0;
                    } else {
                        seleccionado = valor.val().trim() !== "";
                    }

                    if (seleccionado) {
                        $("#" + $variable).slideUp();

                        $next_variable = $(this).parent().next().attr('id');
                        console.log($next_variable);

                        if ($next_variable != undefined) {
                            $("#" + $next_variable).slideDown();
                        } else {
                            $('form').submit();
                        }
                    } else {
                        modalValidacionDatosDiagnostico.show();
                    }
                });

                $('.button-back').click(function() {
                    $variable = $(this).parent().attr('id');
                    $("#" + $variable).slideUp();

                    $before_variable = $(this).parent().prev().attr('id');
                    console.log($before_variable);

                    $("#" + $before_variable).slideDown();
                });

                $('form').on('keydown', function(event) {
                    if (event.key === 'Enter' || event.keyCode === 13) {
                        event.preventDefault();
                        return false;
                    }
                });

                $('form').on('submit', function() {
                    $('.input-numero').each(function() {
                        let limpio = $(this).attr('data-raw');
                        $(this).val(limpio);
                    });
                });

            });

            $(document).on('keypress', '.input-numero', function(e) {
                if (!/[0-9]/.test(e.key)) {
                    e.preventDefault();
                }
            });

            // FORMATEO CON PUNTOS DE MILES
            $(document).on('input', '.input-numero', function() {

                let valor = $(this).val();

                // Eliminar todo lo que no sea número
                valor = valor.replace(/\D/g, '');

                // Guardar valor limpio
                $(this).attr('data-raw', valor);

                if (valor === '') {
                    $(this).val('');
                    return;
                }

                // Formatear con puntos (es-CO)
                let formateado = parseInt(valor, 10).toLocaleString('es-CO');

                $(this).val(formateado);
            });
        </script>
    <?php else: ?>
        <script>
            $(document).ready(function() {
                $('#preguntas_diagnostico_programa').submit();
            });
        </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\jpllinas\Documents\DesarrolloWEB\VPS-RUTAC\APP\rutadecrecimiento\resources\views/website/company/program_questions.blade.php ENDPATH**/ ?>