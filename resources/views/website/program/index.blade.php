@extends('website.layouts.main_dashboard')
@section('title', 'Ruta C Dashboard')
@section('descripcion', '')

@section('content')
<div class="c-dashboard">
    @include('website.layouts.header_company')
    <main class="bg-light">

        <div id="programs" class="container">

            <div class="p-4 shadow bg-white mt-3">
                <div class="row">
                    <div class="col col-md">

                        <div class="company-card text-center p-3">
                            <div class="card-body">
                                <img height="150" style="margin: 0 auto;"
                                    src="
                                        @if(!empty($unidadProductiva->logo))
                                        {{ asset('storage/logos/' . $unidadProductiva->logo) }}
                                        @else
                                            @if($unidadProductiva->unidadtipo_id == 1)
                                                https://rutadecrecimiento.com/img/registro/idea_negocio.png
                                            @elseif($unidadProductiva->unidadtipo_id == 2)
                                                https://rutadecrecimiento.com/img/registro/informal_negocio_en_casa.png
                                            @elseif($unidadProductiva->unidadtipo_id == 3)
                                                https://rutadecrecimiento.com/img/registro/registrado_fuera_ccsm.png
                                            @elseif($unidadProductiva->unidadtipo_id == 4)
                                                https://rutadecrecimiento.com/img/registro/registrado_ccsm.png
                                            @endif
                                        @endif
                                    " 
                                    class="company-image" alt="Imagen de la empresa">
                        
                            
                                <h5 class="card-title pt-4"> <b>{{$unidadProductiva->business_name}}</b> </h5>
                                <p class="card-text">NIT: {{$unidadProductiva->nit}}</p>
                            </div>
                        </div>

                    </div>
                    <div class="col col-md-8 d-flex align-items-center">
                        <div class="w-100" >

                            <div audio-tag="info_program_info" >
                                <h3>
                                    Te encuentras en la etapa de <b>{{ $nombreEtapa }}</b>
                                </h3>
    
                                <hr class="my-4" >
                                <p class="desc">
                                    Teniendo en cuenta el diagnóstico de tu empresa, puedes visualizar todos los programas pero solo podrás aplicar a los que cumplan con tu nivel de calificación.
                                </p>
    
                            </div>

                            @include('website.layouts.button_audio', ['target' => 'info_program_info'])

                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5">

                @if($programas_inscrito)
                    <div class="container text-center mb-4">

                        <div class="row justify-content-center">

                            <div class="col-12">
                                <h1 class="display-1 mb-3">Estás inscrito en....</h1>
                            </div>

                            @foreach($programas_inscrito as $key => $program)
                                <div class="col mb-4">
                                    <ul>
                                        <li audio-tag="info_program_li_{{ $key }}">
                                            <a href="{{ route('company.program.show', ['id' => $program->convocatoria_id]) }}" class="tarjeta_info_programa">
                                                @if(date('Y-m-d', strtotime($program->fecha_cierre_convocatoria)) >= date('Y-m-d'))
                                                    <h3>Registrado</h3>
                                                @else
                                                    <h3>Registrado - Cerrado el {{ date('Y-m-d', strtotime($program->fecha_cierre_convocatoria)) }}</h3>
                                                @endif
                                                <div class="logo">
                                                    <img src="{{ asset('/' . $program->programa->logo) }}" alt="">
                                                </div>
                                                <div class="info">
                                                    <div class="title">
                                                        <h2>
                                                            {{ $program->programa->nombre }} <br>
                                                            <small>{{$program->nombre}}</small>
                                                        </h2>
                                                    </div>
                                                    <p>{{ $program->programa->descripcion }}</p>
                                                    <div class="more">Ver más información</div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="container text-center mb-4">
                        <div class="row justify-content-center">
                            <div class="col">
                                <div class="alert alert-success" role="alert">
                                    <h1 class="alert-heading">¡Inscríbete en nuestros programas!</h1>
                                    <p>Aún no estás inscrito en nuestros programas. Te invitamos a explorar nuestro catálogo de programas habilitados para ti.</p>
                                    <hr>
                                    <p class="mb-0 small">Si necesitas más información, no dudes en contactarnos.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>

            <div class="mt-3">

                <div class="container text-center mb-4">
    
                    <div class="row justify-content-center">

                        <div class="col-12">
                            <h1 class="display-1 mb-3">Te recomendamos inscribirte en.....</h1>
                        </div>  

                        @foreach($programs_recommend as $key => $program)
                            @php($noencontrado = true)
                            @foreach($programas_inscrito as $key2 => $program2)
                                @if($program->convocatoria_id == $program2->convocatoria_id)
                                    @php($noencontrado = false)
                                @endif
                            @endforeach
                
                            @if($noencontrado)
                                <div class="col mb-4">
                                    <ul>
                                        <li audio-tag="info_program_li_{{$key}}">
                                            <a href="{{ route('company.program.show', [$program->convocatoria_id]) }}" class="tarjeta_info_programa">
                                                <h3>Recomendado</h3>
                                                <div class="logo">
                                                    <img src="{{ asset('/'.$program->programa->logo) }}" alt="">
                                                </div>
                                                <div class="info">
                                                    <div class="title"> 
                                                        <h2>
                                                            {{ $program->programa->nombre }} <br>
                                                            <small>{{$program->nombre}}</small>
                                                        </h2>
                                                    </div>
                                                    <p>{{ $program->programa->descripcion }}</p>
                                                    <div class="more">Ver más información</div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

            </div>

            <div class="mt-3">
                <div class="container text-center mb-4">

                    <div class="row justify-content-center">
                        <div class="col-12 mb-3">
                            <h1 class="display-1">...más programas.</h1>
                        </div>
                    </div>
                    
                    <!-- Otros programas -->
                    <div class="row justify-content-center mt-3">
                        @foreach($programas_otros as $key => $program)
                        
                            @php($noencontrado = true)
                            @foreach($programas_inscrito as $key2 => $program2)                    
                                @if( $program->convocatoria_id == $program2->convocatoria_id )
                                    @php($noencontrado = false)
                                @endif                                                                        
                            @endforeach
                            
                            @if($noencontrado) 
                            <div class="col mb-4">
                                <ul class="">
                                    <li audio-tag="info_program_li_{{$key}}" class="">
                                        <a href="{{route('company.program.show', [$program->convocatoria_id])}}" class="tarjeta_info_programa">                                    
                                            <div class="logo">
                                                <img src="{{ asset( 'storage/'.$program->programa->logo ) }}" alt="">
                                            </div>
                                            <div class="info">
                                                <div class="title">
                                                    <h2>
                                                        {{ $program->programa->nombre }} <br>
                                                        <small>{{$program->nombre}}</small>
                                                    </h2>
                                                </div>
                                                <p>
                                                    {{$program->programa->descripcion}}
                                                </p>
                                                <div class="more">Ver más información</div>
                                            </div>
                                        </a>
                                        <!--@include('website.layouts.button_audio', ['target' => 'info_program_li_'.$key])-->
                                    </li>
                                </ul>
                            </div>         
                            @endif
                        @endforeach
                    </div>
                
                    <!--  programas cerrados recomendandos-->
                    <div class="row justify-content-center mt-3">
                        @if($programas_cerrados_recomendados->isNotEmpty())
                            @foreach($programas_cerrados_recomendados as $key => $program)
                                @php($noencontrado = true)
                                @foreach($programas_inscrito as $key2 => $program2)
                                    @if($program->convocatoria_id == $program2->convocatoria_id)
                                        @php($noencontrado = false)
                                    @endif
                                @endforeach
                
                                @if($noencontrado && isset($program->convocatoria_id) && !empty($program->convocatoria_id))
                                    <div class="col mb-4">
                                        <ul>
                                            <li audio-tag="info_program_li_{{ $key }}">
                                                <a href="{{ route('company.program.show', [$program->convocatoria_id]) }}" class="tarjeta_info_programa">
                                                    <h3>Cerrado el {{ date('Y-m-d', strtotime($program->fecha_cierre_convocatoria)) }}</h3>
                                                    <div class="logo">
                                                        <img src="{{ asset('/'.$program->programa->logo) }}" alt="">
                                                    </div>
                                                    <div class="info">
                                                        <div class="title">
                                                            <h2>
                                                                {{ $program->programa->nombre }} <br>
                                                                <small>{{$program->nombre}}</small>
                                                            </h2>
                                                        </div>
                                                        <p>{{ $program->programa->descripcion }}</p>
                                                        <div class="more">Ver más información</div>
                                                    </div>
                                                </a>
                                                @include('website.layouts.button_audio', ['target' => 'info_program_li_'.$key])
                                            </li>
                                        </ul>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <p class="text-center text-muted">No hay programas cerrados recomendados en este momento.</p>
                        @endif
                    </div>

                    <!--  programas cerrados -->
                    <div class="row justify-content-center mt-3">
                        @if($programas_cerrados->isNotEmpty())
                            @foreach($programas_cerrados as $key => $program)
                                @php($noencontrado = true)
                
                                @if($programas_inscrito->isNotEmpty())
                                    @foreach($programas_inscrito as $key2 => $program2)
                                        @if($program->convocatoria_id == $program2->convocatoria_id)
                                            @php($noencontrado = false)
                                        @endif
                                    @endforeach
                                @endif
                
                                @if($noencontrado && isset($program->convocatoria_id) && !empty($program->convocatoria_id))
                                    <div class="col mb-4">
                                        <ul>
                                            <li audio-tag="info_program_li_{{ $key }}">
                                                <a href="{{ route('company.program.show', [$program->convocatoria_id]) }}" class="tarjeta_info_programa">
                                                    <h3>Cerrado el {{ date('Y-m-d', strtotime($program->fecha_cierre_convocatoria)) }}</h3>
                                                    <div class="logo">
                                                        <img src="{{ asset('/'.$program->programa->logo) }}" alt="">
                                                    </div>
                                                    <div class="info">
                                                        <div class="title">
                                                            <h2>
                                                                {{ $program->programa->nombre }} <br>
                                                                <small>{{$program->nombre}}</small>
                                                            </h2>
                                                        </div>
                                                        <p>{{ $program->programa->descripcion }}</p>
                                                        <div class="more">Ver más información</div>
                                                    </div>
                                                </a>
                                                @include('website.layouts.button_audio', ['target' => 'info_program_li_'.$key])
                                            </li>
                                        </ul>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <p class="text-center text-muted">No hay programas cerrados disponibles en este momento.</p>
                        @endif
                    </div>

                </div>
            </div>

        </div>
        
    </main>
    @include('website.layouts.helper')
</div>


<style>
    .tarjeta_info_programa{
        background: white !important;
    }
</style>
@endsection

@section('js')

<script>
    $(document).ready(function () {
        $('header .programs').addClass('active');
    });
</script>
@endsection
