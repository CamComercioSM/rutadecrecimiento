@extends('website.layouts.main')
@section('header-class','without-header')
@section('title','Ruta C')
@section('description','')

@section('content')
{{--@include('website.mantenimiento.modal_aviso')--}}
{{--@include('website.company.aviso_validaciondatos')--}}
<div id="diagnostic">
    <div class="wrap">
        
        <h2>Hola, <b>{{$company->business_name}}</b>!.</h2>
        
        @if($arranquePOR == "NUEVO")
        <h1 class="size-l color-2 font-w-700"> ...ha sido validada y puede continuar el proceso de Diagnóstico de Ruta C...</h1>
        @endif

        @if($arranquePOR == "ANUAL")
        <h1  class="size-l color-2 font-w-700" >Ya ha pasado 1 año desde tu último diagnostico. Vamos a comprobar cuanto hemos crecido durante ese tiempo.</h1>
        @endif

        @if($preguntas == null)
        <section class="step-1">
            <p class="mt-5">A continuación debera indicar si su empresa ha obtenido ventas y responder las preguntas del diagnóstico</p>
            <ul class="mt-40">
                <li>
                    <a href="{{route('company.diagnostic.sells', 'ventas')}}" class="button button-primary">Sí he tenido ventas</a>
                </li>
                <li>
                    <a href="{{route('company.diagnostic.sells', 'sin-ventas')}}" class="button button-third">No tengo ventas</a>
                </li>
            </ul>
        </section>
        @else
        <form id="frm_completardiagnostico" method="post" action="{{route('company.diagnostic.save')}}">
            @csrf
            <input type="hidden" name="sells" value="{{$sells}}" />
            @if($sells == 'ventas')
            <section id="variable-0" class="variable">
                <h2 class="color-2 font-w-700">¿A cuánto ascienden sus ventas anuales?</h2>
                <ul class="hidden">
                    @foreach($ventas as $item)
                    <li>
                        <label class="radio">
                            <input type="radio" id="anual_sales_{{$item->ventasAnualesID}}" name="anual_sales" value="{{$item->ventasAnualesID}}"/>
                            <div class="info">
                                <h3 class="font-w-500">{{$item->ventasAnualesNOMBRE}}</h3>
                            </div>
                        </label>
                    </li>
                    @endforeach
                </ul>
                <button type="button"  id="btn_diagnosticosiguiente_conventas" class="button button-primary mt-20 button-next">Continuar</button>
                <a class="button button-secundary mt-10" href="{{route('company.diagnostic')}}">Regresar</a>
            </section>
            @endif
            @foreach($preguntas as $pregunta)
            <section id="variable-{{$pregunta->pregunta_id}}" class="variable hidden">
                <h2 class="color-2 font-w-700">{{$pregunta->pregunta_titulo}}</h2>
               
                <ul>
                    @if ($pregunta->pregunta_opcionesJSON)                        
                        @foreach($pregunta->pregunta_opcionesJSON as $key => $value)
                            <li>                            
                                <label class="radio">
                                    <input type="radio" id="variable_{{$pregunta->pregunta_id}}_{{$key}}"  name="variable-{{$pregunta->pregunta_id}}" value="{{$key}}"/>
                                    <div class="info font-w-500">
                                        {{$value['attributes']['variable_response']}}
                                    </div>
                                </label>                            
                            </li>
                        @endforeach
                    @endif
                </ul>
                <button type="button" id="btn_diagnosticosiguiente_sinventas" class="button button-primary mt-20 button-next">Continuar</button>
                <button type="button" class="button button-secundary mt-10 button-back">Regresar</button>
            </section>
            @endforeach
        </form>
        @endif
        
    </div>
</div>
@if($preguntas != null)
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
//          console.log(this);
//          console.log($(this).attr('id'));
//          console.log($(this).parent().attr('id'));
//          console.log($(this).parent().parent().attr('id'));
//          console.log($(this).parent().parent().parent().attr('id'));
//          console.log($(this).parent().parent().parent().parent().attr('id'));
                    pasarSiguientePreguntaDiagnostico(
                            $(this).parent().parent().parent().parent().attr('id'),
                            $(this).parent().parent().parent().parent().next().attr('id')
                            );
            });
    });

    function pasarSiguientePreguntaDiagnostico(actualID, siguienteID) {
//      $variable = $("#btn_diagnosticosiguiente_conventas").parent().attr('id');
            $variable = actualID;
            let opcionesRespuesta = $("#" + $variable).find('input[type="radio"]');
            let seleccionado = false;
            console.log(opcionesRespuesta);
            opcionesRespuesta.each(function (index) {
                    if ($(this).is(':checked')) {
                            seleccionado = true;
                    }
            });
            if (seleccionado) {
//      console.log($variable); 
                    $("#" + $variable).slideUp();
//      $next_variable = $("#btn_diagnosticosiguiente_conventas").parent().next().attr('id');
                    $next_variable = siguienteID;
//            console.log($next_variable);
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
@if($sells == 'sin-ventas')
<script>
    $(document).ready(function () {
        $('#variable-{{$preguntas->first()->pregunta_id}}').removeClass('hidden');
    });
</script>
@endif
@endif
@endsection
