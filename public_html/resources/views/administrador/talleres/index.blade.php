@extends('administrador.index')
@section('title','RutaC | Documentos')
@section('content')
<section class="content-header">
	<div class="row">
		<div class="col-sm-8">
			<a class="btn btn-primary" href="javascript:void(0)" data-toggle="modal" data-target="#modal-agregar-taller"><i class="fa fa-file-o"></i> Agregar taller </a>
		</div>
	</div>
</section>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-body">
					<table id="tabla-talleres" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th class="text-center">Taller #</th>
								<th class="text-center">Nombre taller</th>
                                <th class="text-center">URL inscripción</th>
								<th class="text-center" style="width: 150px"></th>
							</tr>
						</thead>
						<tbody>
							@foreach($talleres as $key=> $taller)
							<tr>
								<td class="text-center">{{$key+1}}</td>
								<td class="text-left">{{$taller->tallerNOMBRE}}</td>
								<td class="text-left"><a href="{{$taller->tallerURL}}" target="_blank">{{$taller->tallerNOMBRE}}</a></td>
								<td class="text-center">
									<a class="btn btn-warning btn-xs" href="javascript:void(0)" data-toggle="modal" data-target="#modal-editar-taller" onclick="editarTallerS('{{$taller->tallerID}}','{{$taller->tallerNOMBRE}}','{{$taller->tallerURL}}');return false;">Editar</a>
			                        <a class="btn btn-danger btn-xs" href="javascript:void(0)" data-toggle="modal" data-target="#modal-eliminar-taller" onclick="eliminarTallerS('{{$taller->tallerID}}');return false;">Eliminar</a>
								</td>
							</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
@section('footer')
<script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

<div class="modal fade" id="modal-agregar-taller">
    <div class="modal-dialog">
        <form id="agregarTaller" action="" role="form" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Agregar taller</h4>
                </div>
                <div class="modal-body">
                    {!! csrf_field() !!}
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="nombre_taller">Nombre taller:</label>
                            <div class="form-group has-feedback">
                                <input type="text" name="nombre_taller" class="form-control" placeholder="Nombre del taller" value="">
                                <span class="text-danger" id="error_nombre_taller"></span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label for="url_taller">URL inscripción:</label>
                            <div class="form-group has-feedback">
                                <input type="text" name="url_taller" class="form-control" placeholder="URL de inscripción del taller" value="">
                                <span class="text-danger" id="error_url_taller"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="agregar-taller" class="btn btn-primary">Agregar Taller</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="modal-editar-taller">
    <div class="modal-dialog">
        <form id="editarTaller" action="" role="form" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Editar taller</h4>
                </div>
                <div class="modal-body">
                    {!! csrf_field() !!}
                    <input name="tallerIDE" id="tallerIDE" type="hidden" value="">
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="nombre_taller">Nombre taller:</label>
                            <div class="form-group has-feedback">
                                <input type="text" id="nombre_taller" name="nombre_taller" class="form-control" placeholder="Nombre del taller" value="">
                                <span class="text-danger" id="error_nombre_taller"></span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label for="url_taller">URL taller:</label>
                            <div class="form-group has-feedback">
                                <input type="text" id="url_taller" name="url_taller" class="form-control" placeholder="URL de inscripción del taller" value="">
                                <span class="text-danger" id="error_url_taller"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="editar-taller" class="btn btn-primary">Editar Taller</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="modal-eliminar-taller">
    <div class="modal-dialog">
        <form id="eliminarTaller" action="" role="form" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Eliminar taller</h4>
                </div>
                <div class="modal-body">
                    {!! csrf_field() !!}
                    <input name="tallerID" id="tallerID" type="hidden" value="">
                    <div class="row">
                        <div class="col-lg-12">
                            ¿Seguro que desea eliminar este taller?
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="eliminar-taller" class="btn btn-primary">Eliminar Taller</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
	$('#agregar-taller').click(function(){
        var values = getValuesAgregarTaller();
        agregarTaller(values);
    });
    function getValuesAgregarTaller(){
        var values = new Object;        
        var inputs = $("#agregarTaller").find('input, select');  
        for(var i = 0; i< inputs.length; i++){
            name = $(inputs[i]).attr('name');
            value = $(inputs[i]).val();
            values[name] = value;
            $("input[name='"+name+"'], select[name='"+name+"'], textarea[name='"+name+"']").parents().eq(0).removeClass('has-error');            
            $("#error_"+name).html('');
        }
        return values;
    }
    function agregarTaller(values){
    	$('#modal-agregar-taller').modal('hide');
        $('.capa').css("visibility", "visible");
        $('#agregar-taller').attr("disabled", true);
        $('#message-error').html('');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{url('admin/agregar-taller') }}",
            dataType: 'json',
            type: 'post',
            data: values,
            success: function(data){
                console.log(data);
                if(data.status == 'Ok'){
                    alert(data.mensaje);
                    window.location.href = ""
                }
                if(data.status == 'Errors'){
                    for(var key in data.errors){
                        $("#error_"+key).html("");
                        $("#alert_error_"+key).removeClass('general-error-color');
                        if(data.errors[key] != ""){                            
                            $("input[name='"+key+"'], select[name='"+key+"'], textarea[name='"+key+"']").parents().eq(0).addClass('has-error');
                            $("#error_"+key).html(data.errors[key]);
                            $("#alert_error_"+key).addClass('general-error-color');
                        }
                    }
                    $('.capa').css("visibility", "hidden");
                    $('#agregar-taller').attr("disabled", false);
                }
            },
            error: function(xhr, data, error){
                alert('Ocurrió un error');
                $('.capa').css("visibility", "hidden");
                $('#agregar-taller').attr("disabled", false);
            }
        });
    }
    $('#editar-taller').click(function(){
        var values = getValuesEditarTaller();
        console.log(values);
        editarTaller(values);
    });
    function getValuesEditarTaller(){
        var values = new Object;        
        var inputs = $("#editarTaller").find('input, select');  
        for(var i = 0; i< inputs.length; i++){
            name = $(inputs[i]).attr('name');
            value = $(inputs[i]).val();
            values[name] = value;
            $("input[name='"+name+"'], select[name='"+name+"'], textarea[name='"+name+"']").parents().eq(0).removeClass('has-error');            
            $("#error_"+name).html('');
        }
        return values;
    }
    function editarTaller(values){
    	$('#modal-editar-taller').modal('hide');
        $('.capa').css("visibility", "visible");
        $('#editar-taller').attr("disabled", true);
        $('#message-error').html('');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{url('admin/editar-taller') }}",
            dataType: 'json',
            type: 'post',
            data: values,
            success: function(data){
                console.log(data);
                if(data.status == 'Ok'){
                    alert(data.mensaje);
                    window.location.href = ""
                }
                if(data.status == 'Errors'){
                    for(var key in data.errors){
                        $("#error_"+key).html("");
                        $("#alert_error_"+key).removeClass('general-error-color');
                        if(data.errors[key] != ""){                            
                            $("input[name='"+key+"'], select[name='"+key+"'], textarea[name='"+key+"']").parents().eq(0).addClass('has-error');
                            $("#error_"+key).html(data.errors[key]);
                            $("#alert_error_"+key).addClass('general-error-color');
                        }
                    }
                    $('.capa').css("visibility", "hidden");
                    $('#editar-taller').attr("disabled", false);
                }
                if(data.status == 'Error'){
                    alert(data.mensaje);
                    $('.capa').css("visibility", "hidden");
                    $('#editar-taller').attr("disabled", false);
                }
            },
            error: function(xhr, data, error){
                alert('Ocurrió un error');
                $('.capa').css("visibility", "hidden");
                $('#editar-taller').attr("disabled", false);
            }
        });
    }
    $('#eliminar-taller').click(function(){
        var values = getValuesEliminarTaller();
        eliminarTaller(values);
    });
    function getValuesEliminarTaller(){
        var values = new Object;        
        var inputs = $("#eliminarTaller").find('input, select');  
        for(var i = 0; i< inputs.length; i++){
            name = $(inputs[i]).attr('name');
            value = $(inputs[i]).val();
            values[name] = value;
            $("input[name='"+name+"'], select[name='"+name+"'], textarea[name='"+name+"']").parents().eq(0).removeClass('has-error');            
            $("#error_"+name).html('');
        }
        return values;
    }
    function eliminarTaller(values){
    	$('#modal-eliminar-taller').modal('hide');
        $('.capa').css("visibility", "visible");
        $('#eliminar-taller').attr("disabled", true);
        $('#message-error').html('');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{url('admin/eliminar-taller') }}",
            dataType: 'json',
            type: 'post',
            data: values,
            success: function(data){
                console.log(data);
                if(data.status == 'Ok'){
                    alert(data.mensaje);
                    window.location.href = "{{URL::to('admin/talleres')}}"
                }
                if(data.status == 'Error'){
                    alert(data.mensaje);
                    $('.capa').css("visibility", "hidden");
                    $('#eliminar-taller').attr("disabled", false);
                }
            },
            error: function(xhr, data, error){
                alert('Ocurrió un error');
                $('.capa').css("visibility", "hidden");
                $('#eliminar-taller').attr("disabled", false);
            }
        });
    }
    function editarTallerS(tallerID,nombreTaller,urlTaller){
        $('#tallerIDE').val(tallerID);
        $('#nombre_taller').val(nombreTaller);
        $('#url_taller').val(urlTaller);
    }
    function eliminarTallerS(tallerID){
        $('#tallerID').val(tallerID);
    }
    $(function () {
	    $("#tabla-taller").DataTable({
	      "paging": true,
	      "lengthChange": true,
	      "searching": true,
	      "ordering": false,
	      "info": false,
	      "autoWidth": false,
	      "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
	      "pageLength": 100,
		  "language": {
				"sProcessing":    "Procesando...",
				"sLengthMenu":    "Mostrar _MENU_ registros",
				"sZeroRecords":   "No se encontraron resultados",
				"sEmptyTable":    "Ho se encontraron rutas",
				"sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
				"sInfoEmpty":     "Mostrando registros del 0 al 0 de un total de 0 registros",
				"sInfoFiltered":  "(filtrado de un total de _MAX_ registros)",
				"sInfoPostFix":   "",
				"sSearch":        "Buscar:",
				"sUrl":           "",
				"sInfoThousands":  ",",
				"sLoadingRecords": "Cargando...",
				"oPaginate": {
					"sFirst":    "Primero",
					"sLast":    "Último",
					"sNext":    "Siguiente",
					"sPrevious": "Anterior"
				},
				"oAria": {
					"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
				}
			}
	    });
	    
	});
	
</script>

@endsection