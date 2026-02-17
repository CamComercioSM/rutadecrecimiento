<section class="w-100 hidden" id="matriculaEstablecimiento">
    <div id="matriculaEstablecimientoBusqueda">

        <h2 class="color-2 font-w-700 my-5">
            Busca el establecimiento registrado
        </h2>

        <p>
            Seleccione el criterio de búsqueda del establecimiento.
        </p>

        <form class="row" id="matriculaEstablecimientoForm">

            <div class="col-12 col-md-6 form-group mb-3">
                <label class="form-label">Criterio de búsqueda</label>
                <select class="form-select" id="search_type_est" required>
                    <option value="RAZONSOCIAL">Razón social</option>
                    <option value="MATRICULA">Matrícula del establecimiento</option>
                </select>
            </div>

            <div class="col-12 col-md-6 form-group mb-3">
                <label class="form-label">Búsqueda</label>
                <input class="form-control" type="text" id="search_name_est" required />
            </div>

            <div class="col-12 my-3">
                <button type="submit" class="button button-primary">
                    BUSCAR ESTABLECIMIENTO
                </button>
                <button type="button" id="matriculaEstVolver" class="button button-secundary mt-3">
                    VOLVER
                </button>
            </div>

        </form>
    </div>

    <div class="hidden" id="matriculaEstDetalle">

        <h1 class="size-l color-2 font-w-700">
            Seleccione el establecimiento
        </h1>

        <div id="busquedaResultadoEst"></div>

        <div class="col-12 my-3">
            <button type="button" id="matriculaEstCorrectoBtn" class="button button-primary">
                CONTINUAR
            </button>
            <button type="button" id="matriculaEstBusquedaBtn" class="button button-secundary mt-3">
                VOLVER
            </button>
        </div>

    </div>
</section>


<script>
    $(document).ready(function () {

        $('#matriculaEstablecimientoForm').on('submit', function (e) {

            e.preventDefault();

            const name = $('#search_name_est').val();
            const type = $('#search_type_est').val();

            $('#screenLoader').removeClass('d-none');
            ocultarAlerta();
            $('#busquedaResultadoEst').html('');

            $.ajax({
                url: '/registro/buscar-establecimiento',
                method: 'POST',
                data: {
                    search_type: type,
                    search_name: name,
                    _token: '<?php echo e(csrf_token()); ?>'
                },
                success: function (response) {

                    if (!response.success) {
                        return mostrarAlerta(response.mensaje);
                    }

                    response.listado.forEach(item => {

                        $('#busquedaResultadoEst').append(`
                        <label class="unidad shadow-sm p-3 my-2 d-block border rounded position-relative">
                            <input type="radio" name="establecimientoSeleccionado"
                                   value="${item.matricula}"
                                   style="position:absolute; right:11px; transform:scale(2);" required />
                            <p>
                                Razón social: <b>${item.nombre}</b><br>
                                Dirección: <b>${item.direccion}</b><br>
                                Matrícula: <b>${item.matricula}</b><br>
                                Fecha: <b>${item.fechamatricula}</b>
                            </p>
                        </label>
                    `);
                    });

                    $("#matriculaEstablecimientoBusqueda").slideUp();
                    $("#matriculaEstDetalle").slideDown();
                },
                complete: function () {
                    $('#screenLoader').addClass('d-none');
                }
            });
        });

        $('#matriculaEstCorrectoBtn').on('click', function () {

            const matricula = $('input[name="establecimientoSeleccionado"]:checked').val();

            if (!matricula) {
                return mostrarAlerta("Seleccione un establecimiento.");
            }

            $('#screenLoader').removeClass('d-none');

            $.ajax({
                url: '/registro/buscar-establecimiento/detalles',
                method: 'POST',
                data: {
                    matricula: matricula,
                    _token: '<?php echo e(csrf_token()); ?>'
                },
                success: function (response) {

                    if (!response.success) {
                        return mostrarAlerta(response.mensaje);
                    }

                    for (let input in response.datos) {
                        $("#" + input).val(response.datos[input]);
                    }

                    $("#matriculaEstablecimiento").slideUp();
                    $("#matriculaFormal").slideDown();
                },
                complete: function () {
                    $('#screenLoader').addClass('d-none');
                }
            });
        });

        $('#matriculaEstVolver').on('click', function () {
            $("#matriculaEstablecimiento").slideUp();
            $("#tipoRegistro").slideDown();
        });

        $('#matriculaEstBusquedaBtn').on('click', function () {
            $("#matriculaEstDetalle").slideUp();
            $("#matriculaEstablecimientoBusqueda").slideDown();
        });

    });
</script><?php /**PATH C:\Users\jpllinas\Documents\DesarrolloWEB\VPS-RUTAC\APP\rutadecrecimiento\resources\views/website/register/parciales/matriculaEstablecimiento.blade.php ENDPATH**/ ?>