@extends('website.layouts.main_dashboard')
@section('title','Ruta C Dashboard')
@section('description','')

@section('content')
    <div class="c-dashboard">
        @include('website.layouts.header_company')
        <main>
            <div id="programs-show">
                <div class="resume textl">
                    <img class="logo" src="{{ asset(''.$convocatoria->programa->logo) }}" alt="">
                    <div audio-tag="info_program_info_show">
                        <h1 class="mt-4">
                            {{$convocatoria->programa->nombre}}
                        </h1>
                        <h2 class="mt-3">
                            {{$convocatoria->nombre}}
                        </h2>
                        
                        @if($already_subscribed)
                            <div class="already-subscribed mt-20">
                                <h3 class="font-w-700">Ya hay una inscripción activa</h3>
                                <span class="block mt-5 title">El estado de su inscripción es</span>
                                <span class="state font-w-700">
                                    {{ $inscripcion->estado->inscripcionEstadoNOMBRE }}
                                </span>
                                @if($inscripcion->comments != null)
                                    <p class="mt-20 comments">
                                        Comentarios: {{$inscripcion->comments}}
                                    </p>
                                @endif
                            </div>
                        @else
                            @if($can_apply)
                                @if(isset($inscripcion) && $inscripcion->inscripcionestado_id == 3)
                                    <p class="mt-20 comments">
                                        Su última solicitud no ha sido admitida. Sin embargo, puede volver a presentar su solicitud de inscripción.
                                    </p>
                                @endif
                                <h1 class="can-apply mt-20">Cumple con requisitos para inscripción.</h1>
                                @if(date('Y-m-d', strtotime($convocatoria->fecha_cierre_convocatoria)) >= date('Y-m-d'))
                                    <a class="button button-primary mt-10" href="{{ route('company.program.register', [$convocatoria->convocatoria_id]) }}">Validar e inscribirme</a>
                                @endif
                            @endif
                        @endif
                        
                    </div>
                    @include('website.layouts.button_audio', ['target' => 'info_program_info_show'])
                </div>
                <div class="info" audio-tag="info_program_info_show_content">
                    <div class="wrap wrap-large textl">

                        @if($inscripcion)
                            <div class="shadow-sm p-4 mb-4">

                                <div class="row d-flex">
                                    <div class="col-12 col-md-6">

                                        <h2 style="text-align: center;"> <b>Estados del proceso</b> </h2>

                                        <div class="timeline">

                                            @foreach($inscripcion->historial()->orderBy('fecha_creacion', 'desc')->get() as $item)
                                            <div class="timeline-event">
                                                <div class="timeline-content">
                                                    <h3><b>{{$item->estado->inscripcionEstadoNOMBRE}}</b></h3>
                                                    <p> 
                                                        {{$item->comentarios}}
                                                        @if($inscripcion->file != null)
                                                            <br>
                                                            <a href="{{ Storage::url($inscripcion->file) }}" target="_blank" title="ver archivo adjunto">ver archivo adjunto</a>                                  
                                                        @endif
                                                        
                                                    </p>
                                                    <span class="date">{{$item->fecha_creacion}}</span>
                                                </div>
                                            </div>
                                            @endforeach

                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <h2>
                                            <b>Preguntas</b>
                
                                            <a class="btn btn-sm btn-info" style="float: right;" href="/exportarPreguntasInscripcionConvocatoria/{{$inscripcion->inscripcion_id}}">
                                                Exportar
                                            </a>
                                        </h2>

                                        <ul class="list-group list-group-flush mt-4">
                                            @foreach ($inscripcion->respuestas as $resp)
                                            
                                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                                    <div class="ms-2 me-auto">
                                                        <div class="fw-bold">{{ $resp->requisito->requisito_titulo }}</div>
                                                        {{ $resp->value }}
                                                    </div>
                                                    <span class="badge bg-primary rounded-pill">{{ $resp->fecha_respuesta }}</span>
                                                </li>
                                                
                                            @endforeach 
                                        </ul>

                                    </div>
                                </div>

                            </div>

                            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                Ver detalles del programa
                            </button>

                        @endif

                        <div class="collapse {{ !$inscripcion ? 'show' : '' }} mt-4" id="collapseExample">
                           
                            <div class="row d-flex">
                                <div class="col col-md-12 mb-4">
                                    <h2>Beneficios</h2>
                                    <p> {{$convocatoria->programa->beneficios}} </p>
                                </div>

                                <div class="col col-md-12 mb-4">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <h2>Modalidad</h2>
                                                    <p> {{$convocatoria->programa->es_virtual == 0 ? 'Presencial' : 'Virtual'}} </p>
                                                </td>
                                                <td>
                                                    <h2>Dimensión</h2>
                                                    <p> {{$convocatoria->programa->determinantes}} </p>
                                                </td>
                                                <td>
                                                    <h2>Aporte</h2>
                                                    <p> {{$convocatoria->programa->informacion_adicional}} </p>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col col-md-12 mb-5">
                                    <h2>El objetivo que se desea lograr</h2>
                                    <p> {{$convocatoria->programa->objetivo}} </p>
                                </div>

                                <div class="col col-md-6 mb-4">
                                    <h2>Duración del programa</h2>
                                    <p> {{$convocatoria->programa->duracion}} </p>
                                </div>

                                <div class="col col-md-6 mb-4">
                                    <h2>Dirigido a</h2>
                                    <p> {{$convocatoria->programa->dirigido_a}} </p>
                                </div>

                                <div class="col col-md-12 mb-5">
                                    <h2 class="text-center">Procedimiento</h2>
                                    <img class="w-100" src="{{ asset(''.$convocatoria->programa->procedimiento_imagen) }}" alt="">
                                </div>

                                <div class="col col-md-12 mb-4">
                                    <h2>Información adicional</h2>
                                    <p> {{$convocatoria->programa->herramientas_requeridas}} </p>
                                </div>

                                <div class="col col-md-12 mb-4">
                                    <a href="{{$convocatoria->programa->sitio_web}}" target="_blank">
                                        {{$convocatoria->programa->sitio_web}}
                                    </a>
                                </div>

                                <div class="col col-md-12 mb-4">
                                    <hr>
                                </div>


                                <div class="col col-md-12 mb-4">
                                    <h2 class="mt-40">Mayor información</h2>
                                    <ul class="links">
                                        <li>
                                            Persona de contacto
                                            <b>{{$convocatoria->persona_encargada}}</b>
                                        </li>
                                        <li>
                                            Email de contacto
                                            <b>{{$convocatoria->correo_contacto}}</b>
                                        </li>
                                        <li>
                                            Teléfono de contacto
                                            <b>{{$convocatoria->telefono}}</b>
                                        </li>
                                    </ul> 
                                </div>
                                
                            </div>
                           
                            @include('website.layouts.button_audio', ['target' => 'info_program_info_show_content'])

                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </main>
    </div>


<style>
/* Estilos generales para la línea de tiempo */
.timeline {
  position: relative;
  margin: 20px auto;
  padding: 10px;
  width: 100%;
  max-width: 800px;
  border-left: 3px solid #3498db; /* Línea vertical */
}

.timeline-event {
  position: relative;
  padding-left: 20px;
  margin-bottom: 20px;
}

.timeline-event::before {
  content: '';
  position: absolute;
  left: -5px;
  top: 43%;
  width: 20px;
  height: 20px;
  background-color: #3498db;
  border-radius: 50%;
  border: 3px solid white; /* Borde blanco para resaltar el punto */
  box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
}

/* Contenido de cada evento en la línea de tiempo */
.timeline-content {
  padding: 10px 15px;
  background-color: #f9f9f9;
  border-radius: 6px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  width: 100%;
}

.timeline-content h3 {
  margin-top: 0;
  color: #3498db;
}

.timeline-content p {
  margin: 10px 0;
  color: #333;
}

.date {
  font-size: 12px;
  color: #888;
  display: block;
  margin-top: 10px;
  text-align: right;
}

.timeline-event:nth-child(odd) {
    padding-left: 30px; /* Desplazar los eventos impares hacia la derecha */
}

.timeline-event:nth-child(odd) .timeline-content {
    padding-left: -30px; /* Alinear contenido hacia la izquierda */
}

/* Estilos responsivos */
@media screen and (max-width: 768px) {
  .timeline {
    padding: 10px;
  }
  
  .timeline-event {
    margin-left: 0;
  }
  
  .timeline-event::before {
    left: 50%;
    transform: translateX(-50%);
  }

  .timeline-content {
    width: 90%;
    margin-left: 0;
  }
}

</style>

@endsection
