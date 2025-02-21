@extends('website.layouts.main')
@section('header-class','without-header')
@section('title','Ruta C')
@section('description','')

@section('content')
{{--@include('website.mantenimiento.modal_aviso')--}}

@include('website.company.aviso_validaciondatos')

<div id="diagnostic">
    <div class="wrap">
        
        <h2>Hola, <b>{{$company->business_name}}</b>!.</h2>
        
        @if($arranquePOR == "NUEVO")
        <h1 class="size-l color-2 font-w-700"> ...ha sido validada y puede continuar el proceso de Diagnóstico de Ruta C...</h1>
        @endif

        @if($arranquePOR == "ANUAL")
        <h1  class="size-l color-2 font-w-700" >Ya ha pasado 1 año desde tu último diagnostico. Vamos a comprobar cuanto hemos crecido durante ese tiempo.</h1>
        @endif

        @if(!(isset($preguntas) && $preguntas != null))
            <section class="step-1">
                <p class="mt-5">A continuación debera indicar si su empresa ha obtenido ventas y responder las preguntas del diagnóstico</p>
                <ul class="mt-40">
                    <li>
                        <form id="frm_completardiagnostico" method="post" action="{{route('company.diagnostic.saveVenta')}}">
                            @csrf
                            <input type="hidden" name="anual_sales" value="1" >
                            <button class="button button-primary">Sí he tenido ventas</button>
                        </form>
                    </li>
                    <li>
                        <form id="frm_completardiagnostico" method="post" action="{{route('company.diagnostic.saveVenta')}}">
                            @csrf
                            <input type="hidden" name="anual_sales" value="0" >
                            <button class="button button-primary">No tengo ventas</button>
                        </form>
                    </li>
                </ul>
            </section>
        @else
            <form id="frm_completardiagnostico" method="post" action="{{route('company.diagnostic.save')}}">
                @csrf
                <input type="hidden" name="diagnosticoId" value="{{$diagnosticoId}}" />
                
                @foreach($preguntas as $pregunta)
                    <section id="variable-{{$pregunta->pregunta_id}}" class="variable hidden">
                        <h2 class="color-2 font-w-700">{{$pregunta->pregunta_titulo}}</h2>
                    
                        <ul style="padding:0" >  
                            @foreach($pregunta->opciones as $item)
                                <li>                            
                                    <label class="radio">
                                        <input type="radio" id="variable_{{$pregunta->pregunta_id}}_{{$item->opcion_id}}" name="variable-{{$pregunta->pregunta_id}}" value="{{$item->opcion_id}}"/>
                                        <div class="info font-w-500">
                                            {{$item->opcion_variable_response}}
                                        </div>
                                    </label>                            
                                </li>
                            @endforeach
                        </ul>
                        <button type="button" id="btn_diagnosticosiguiente_sinventas" class="button button-primary mt-20 button-next">Continuar</button>
                        <button type="button" class="button button-secundary mt-10 button-back">Regresar</button>
                    </section>
                @endforeach
            </form>
        @endif
        
    </div>
</div>
@if((isset($preguntas) && $preguntas != null))
<script>
    $(document).ready(function () {
            $('.button-next').click(function () {
                    pasarSiguientePreguntaDiagnostico($(this).parent().attr('id'), $(this).parent().next().attr('id'));
            });
            $('.button-back').click(function () {
                    $variable = $(this).parent().attr('id');

                    if ($variable == 'variable-4') {
                            window.location.href = "{{route('company.diagnostic')}}";
                    }

                    $("#" + $variable).slideUp();

                    $before_variable = $(this).parent().prev().attr('id');
                    //console.log($before_variable);

                    $("#" + $before_variable).slideDown();
            });
            $("#frm_completardiagnostico input").change(function () {
                    pasarSiguientePreguntaDiagnostico(
                            $(this).parent().parent().parent().parent().attr('id'),
                            $(this).parent().parent().parent().parent().next().attr('id')
                            );
            });

            $('form').on('keydown', function(event) {
                    if (event.key === 'Enter' || event.keyCode === 13) {
                        event.preventDefault();
                        return false;  
                    }
            });
    });

    function pasarSiguientePreguntaDiagnostico(actualID, siguienteID) {
            $variable = actualID;
            let opcionesRespuesta = $("#" + $variable).find('input[type="radio"]');
            let seleccionado = false;
            
            opcionesRespuesta.each(function (index) {
                    if ($(this).is(':checked')) {
                            seleccionado = true;
                    }
            });

            if (seleccionado) {
                    $("#" + $variable).slideUp();
                    $next_variable = siguienteID;
                    
                    if ($next_variable !== undefined) {
                        $("#" + $next_variable).slideDown();
                    } else {
                        $('form').submit();
                    }
            } else {
                    modalValidacionDatosDiagnostico.show();
            }
    }
</script>
@if($diagnosticoId != 1)
<script>
    $(document).ready(function () {
        $('#variable-{{$preguntas->first()->pregunta_id}}').removeClass('hidden');
    });
</script>
@endif
@endif
@endsection
