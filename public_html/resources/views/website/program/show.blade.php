@extends('website.layouts.main_dashboard')
@section('title','Ruta C Dashboard')
@section('description','')

@section('content')
    <div class="c-dashboard">
        @include('website.layouts.header_company')
        <main>
            <div id="programs-show">
                <div class="resume textl">
                    <img class="logo" src="{{ asset('storage/'.$program->logo) }}" alt="">
                    <div audio-tag="info_program_info_show">
                        <h1 class="mt-20">{{$program->nombre}}</h1>
                        <p class="mt-10">
                            {{$program->descripcion}}
                        </p>
                        @if($already_subscribed)
                            <div class="already-subscribed mt-20">
                                <h3 class="font-w-700">Ya hay una inscripción activa</h3>
                                <span class="block mt-5 title">El estado de su inscripción es</span>
                                <span class="state font-w-700">
                                    {{ \App\Models\ConvocatoriaInscripcion::$states[$inscripcion->inscripcionestado_id] }}
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
                                @if(date('Y-m-d', strtotime($program->fecha_cierre_convocatoria)) >= date('Y-m-d'))
                                    <a class="button button-primary mt-10" href="{{ route('company.program.register', [$program->convocatoria_id]) }}">Validar e inscribirme</a>
                                @endif
                            @endif
                        @endif
                        <div>
                            @if($inscripcion)
                                @if($inscripcion->comments != null)
                                    <p class="mt-20 comments">
                                        Comentarios: {{$inscripcion->comments}}
                                    </p>                                    
                                @endif
                                @if($inscripcion->file != null)
                                    <p class="mt-20 comments">
                                        <a href="{{ Storage::url($inscripcion->file) }}" target="_blank" title="ver archivo adjunto">ver archivo adjunto</a>
                                    </p>                                    
                                @endif                                   
                            @endif
                        </div>
                    </div>
                    @include('website.layouts.button_audio', ['target' => 'info_program_info_show'])
                </div>
                <div class="info" audio-tag="info_program_info_show_content">
                    <div class="wrap wrap-large textl">
                        <h2>Beneficios</h2>
                        <p class="mt-10">
                            {{$program->beneficios}}
                        </p>

                        <h2 class="mt-40">Requisitos</h2>
                        <p class="mt-10">
                            {{$program->requisitos}}
                        </p>

                        <h2 class="mt-40">Modalidad</h2>
                        <p class="mt-10">
                           {{$program->es_virtual == 0 ? 'Presencial' : 'Virtual'}}
                        </p>

                        <h2 class="mt-40">Fechas de convocatoria</h2>
                        <p class="mt-10">
                            {{$program->dirigido_a}}<br/>
                            Duración: <b>{{$program->duracion}}</b>
                        </p>

                        <h2 class="mt-40">El objetivo que se desea lograr</h2>
                        <p class="mt-10">
                            {{$program->objetivo}}
                        </p>

                        <h2 class="mt-40">Dimensión</h2>
                        <p class="mt-10">
                            {{$program->determinantes}}
                        </p>

                        <h2 class="mt-40">Aporte</h2>
                        <p class="mt-10">
                            {{$program->informacion_adicional}}
                        </p>

                        <h2 class="mt-40">Procedimiento</h2>
                        <img class="mt-10 procedure" src="{{ asset('storage/'.$program->procedimiento_imagen) }}" alt="">

                        <h2 class="mt-40">Información adicional</h2>
                        <p class="mt-10">
                            {{$program->herramientas_requeridas}}
                        </p>

                        <h2 class="mt-40">Mayor información</h2>
                        <ul class="links">
                            <li>
                                Persona de contacto
                                <b>{{$program->persona_encargada}}</b>
                            </li>
                            <li>
                                Email de contacto
                                <b>{{$program->correo_contacto}}</b>
                            </li>
                            <li>
                                Teléfono de contacto
                                <b>{{$program->telefono}}</b>
                            </li>
                            <li>
                                <a href="{{$program->sitio_web}}">
                                    {{$program->sitio_web}}
                                </a>
                            </li>
                        </ul>
                    </div>
                    @include('website.layouts.button_audio', ['target' => 'info_program_info_show_content'])
                </div>
            </div>
        </main>
    </div>
@endsection
