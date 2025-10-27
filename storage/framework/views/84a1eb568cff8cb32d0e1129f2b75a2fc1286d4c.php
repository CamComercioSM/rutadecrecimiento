<section class="w-100 hidden" id="matriculaFormal">

    <h2 class="color-2 font-w-700 my-5">
        Información de la unidad
    </h2>
        
    <form class="row" id="matriculaFormalForm">

        <div class="col-12 col-md-12 form-group mb-3">
            <label class="form-label">Seleccione la Cámara de Comercio a la que pertenece </label>
            <select class="form-select" id="camara_comercio" name="camara_comercio" required>
                <option value="0">Seleccione una opción</option>
                <?php $__currentLoopData = $camaras; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $camara): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($camara->camaraCODIGO); ?>"><?php echo e($camara->camaraNOMBRE); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="col-12 col-md-6 form-group mb-3">
            <label class="form-label">Número de Matrícula</label>
            <input type="text" class="form-control" placeholder="Número de Matricula" name="registration_number" id="registration_number" required />
        </div>

        <div class="col-12 col-md-6 form-group mb-3">
            <label class="form-label">Número de Identificación Tributraria [NIT] </label>
            <input type="text" class="form-control" id="nit_registrado" name="nit_registrado" placeholder="Número de Identificación Tributraria" required />
        </div>

        <div class="col-12 col-md-12 form-group mb-3 name_legal_representative">
            <label class="form-label">Nombre del Respresentante Legal </label>
            <input type="text" class="form-control" placeholder="Respresentante Legal" name="name_legal_representative" id="name_legal_representative" required />
        </div>

        <div class="col-12 col-md-12 form-group mb-3 name_legal_representative">
            <label class="form-label">Razón social</label>
            <input type="text" class="form-control" placeholder="Razón social" name="razon_social" id="razon_social" required />
        </div>        

        <div class="col-12 col-md-12 my-3">
            <button type="submit" id="matriculaFormalBtn" class="button button-primary">CONTINUAR</button>
            <button type="button" id="matriculaFormalVolver" class="button button-secundary mt-3">VOLVER</button>
        </div>

    </form>
</section>

<script>
    $(document).ready(function () {
    
        $('#matriculaFormalForm').on('submit', function (e) {
            e.preventDefault();

            $("#business_name").val( $("#razon_social").val() );

            $("#matriculaFormal").slideUp();
            $("#infoUnidad").slideDown();            
        });

        $('#matriculaFormalVolver').on('click', function () {

            let tipoRegistroRUTAC = $('input[name="tipoRegistroRUTAC"]:checked').val();

            $("#matriculaFormal").slideUp();

            if(tipoRegistroRUTAC === '4')
            {
                $("#matriculaCCSM").slideDown();
            }
            else{
                $("#tipoRegistro").slideDown();
            }
        });

    });
</script><?php /**PATH C:\Users\Dir-CIDS\Documents\RutaC_Brayan\rutadecrecimiento-1\resources\views/website/register/parciales/matriculaFormal.blade.php ENDPATH**/ ?>