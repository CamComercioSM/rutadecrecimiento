
<?php $__env->startSection('title','Ruta C Dashboard'); ?>
<?php $__env->startSection('description',''); ?>

<?php $__env->startSection('content'); ?>
<div class="c-dashboard">
    <?php echo $__env->make('website.layouts.header_company', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <main>
        <div id="profile">
            <div class="resume textl">
                <div audio-tag="info_profile">
                    <?php if($company->logo != null): ?>
                    <div class="avatar" style="background-image: url('<?php echo e(env('APP_URL').'/'.$company->logo); ?>') "></div>
                    <?php else: ?>
                    <div class="avatar avatar-empty"></div>
                    <?php endif; ?>
                    <h1 class="mt-40 bold"><?php echo e($company->business_name); ?></h1>
                    <?php if($company->description != null): ?>
                    <p class="mt-20"><?php echo e($company->description); ?></p>
                    <?php endif; ?>
                    <ul class="mt-40 textl">
                        <li>
                            <h3>Nit</h3>
                            <?php echo e($company->nit); ?>

                        </li>
                        <li>
                            <h3>Matrícula mercantil</h3>
                            <?php echo e($company->registration_number); ?>

                        </li>
                        <li>
                            <h3>Email registrado en Cámara de comercio</h3>
                            <?php echo e($company->registration_email); ?>

                        </li>
                        <li>
                            <h3>Email de Usuario/Acceso</h3>
                            <?php echo e($user->email); ?>

                        </li>
                        <li>
                            <h3>Representante legal</h3>
                            <?php echo e($company->name_legal_representative); ?>

                        </li>
                    </ul>
                </div>
                <?php echo $__env->make('website.layouts.button_audio', ['target' => 'info_profile'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <a class="button button-primary mt-40" href="<?php echo e(route('company.profile.update')); ?>">Actualizar información</a>
                <a class="button button-secundary mt-10" href="<?php echo e(route('company.password.update')); ?>">Actualizar contraseña</a>
            </div>
            <div class="all table-responsive" audio-tag="info_major">
                <table>
                    <tr>
                        <td colspan="2" class="title">Información principal</td>
                    </tr>
                    <tr>
                        <td>Tamaño</td>
                        <td><?php echo e($company->tamano()->first()->tamanoNOMBRE ?? ''); ?></td>
                    </tr>
                    <tr>
                        <td>Tipo de Persona</td>
                        <td><?php echo e($company->tipoPersona()->first()->tipoPersonaNOMBRE ?? ''); ?></td>
                    </tr>
                    <tr>
                        <td>Sector</td>                        
                        <td><?php echo e($company->sector()->first()->sectorNOMBRE ?? ''); ?></td>
                    </tr>
                    <tr>
                        <td>Actividad económica</td>
                        <td><?php echo e($company->ciiuActividad()->first()->ciiuActividadCODIGO ?? ''); ?> - <strong><?php echo e($company->ciiuActividad()->first()->ciiuActividadTITULO  ?? ''); ?></strong></td>
                    </tr>
                    <tr>
                        <td>¿Afiliado?</td>
                        <td><?php echo e($company->affiliated == 1 ? 'SI' : 'NO'); ?></td>
                    </tr>
                    <tr>
                        <td>Departamento</td>
                        <td><?php echo e($company->departamento()->first()->departamentoNOMBRE ?? '-'); ?></td>
                    </tr>
                    
                    <tr>
                        <td>Municipio</td>
                        <td><?php echo e($company->municipio()->first()->municipioNOMBREOFICIAL ?? '-'); ?></td>
                    </tr>
                    
                    <tr>
                        <td>Dirección</td>
                        <td><?php echo e($company->address); ?></td>
                    </tr>
                    <tr>
                        <td>Teléfono</td>
                        <td><?php echo e($company->telephone ?? '-'); ?></td>
                    </tr>
                    <tr>
                        <td>Celular</td>
                        <td><?php echo e($company->mobile ?? '-'); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="title">Persona de contacto</td>
                    </tr>
                    <tr>
                        <td>Nombre</td>
                        <td><?php echo e($company->contact_person); ?></td>
                    </tr>
                    <tr>
                        <td>Cargo</td>
                        <td><?php echo e($company->contact_position); ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo e($company->contact_email); ?></td>
                    </tr>
                    <tr>
                        <td>Celular</td>
                        <td><?php echo e($company->contact_phone ?? '-'); ?></td>
                    </tr>
                    <tr>
                        <td>Sexo</td>
                        <td><?php echo e($company->contact_sexo ?? '-'); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="title">Información complementaria</td>
                    </tr>
                    <tr>
                        <td>URL de Sitio web</td>
                        <td><?php echo e($company->website ?? '-'); ?></td>
                    </tr>
                    <tr>
                        <td>Facebook</td>
                        <td><?php echo e($company->social_facebook ?? '-'); ?></td>
                    </tr>
                    <tr>
                        <td>Instagram</td>
                        <td><?php echo e($company->social_instagram ?? '-'); ?></td>
                    </tr>
                    <tr>
                        <td>LinkedIn</td>
                        <td><?php echo e($company->social_linkedin ?? '-'); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="title">Ubicación</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <img src="https://maps.googleapis.com/maps/api/staticmap?center=<?php echo e($company->geolocation); ?>&zoom=17&size=800x300&markers=color:red|<?php echo e($company->geolocation); ?>&key=AIzaSyCPqpt_YwJzrvm0CuQndesni_zZ_8GTDUA">
                        </td>
                    </tr>
                </table>
                <?php echo $__env->make('website.layouts.button_audio', ['target' => 'info_major'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                
                <br><br>
                <div class="container " style="font-size: 70%;" >
                <!--programas inscrito  titulo-->
                <div class="container text-center mb-4">
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <h4 style='font-size:25px'>Inscripciones a Programas.</h4>
                        </div>
                    </div>
                </div>            
                <!--programas inscrito-->
                <div class="container-fluid text-center mb-4">
                    <div class="row justify-content-center"">
                        <?php $__currentLoopData = $programas_inscrito; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        
                        <div class="col mb-4">
                            <ul class="">
                                <li audio-tag="info_program_li_<?php echo e($key); ?>" class="">
                                    <a href="<?php echo e(route('company.program.show', [$program->id])); ?>" class="tarjeta_info_programa">
                                        <?php if(date('Y-m-d', strtotime($program->convocatoriaFCHCIERRE)) >= date('Y-m-d') ): ?>
                                        <h3>Registrado </h3>
                                        <?php else: ?>
                                        <h3>Registrado - Cerrado el <?php echo e(date('Y-m-d', strtotime($program->convocatoriaFCHCIERRE))); ?></h3>
                                        <?php endif; ?>
                                        <div class="logo">
                                            <img src="<?php echo e(asset( 'storage/'.$program->logo )); ?>" alt="">
                                        </div>
                                        <div class="info">
                                            <div class="title">
                                                <h2><?php echo e($program->name); ?></h2>
                                            </div>
                                            <p>
                                                <?php echo e($program->description); ?>

                                            </p>
                                            <div class="more">Ver más información</div>
                                        </div>
                                    </a>
                                    <!--<?php echo $__env->make('website.layouts.button_audio', ['target' => 'info_program_li_'.$key], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>-->
                                </li>
                            </ul>
                        </div>               
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </main>
    <?php echo $__env->make('website.layouts.helper', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script>
    $(document).ready(function () {
            $('header .profile').addClass('active');
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('website.layouts.main_dashboard', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\jpllinas\Documents\DesarrolloWEB\VPS-RUTAC\APP\rutadecrecimiento\resources\views/website/company/profile.blade.php ENDPATH**/ ?>