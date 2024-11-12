@extends('website.layouts.main_dashboard')
@section('title','Ruta C Dashboard')
@section('descripcion','')

@section('content')
<div class="c-dashboard">
    @include('website.layouts.header_company')
    <main>
        <div id="programs">
            <div class="wrap wrap-large textl mb-4">
                <div audio-tag="info_program_info">
                    <h1>{{$unidadProductiva->business_nombre}}</h1>
                    <h3 class="mt-5">Te encuentras en la etapa de <b>{{ $nombreEtapa }}</b></h3>
                    <hr class="mt-10 mb-10"/>
                    <p class="desc">
                        Teniendo en cuenta el diagnóstico de tu empresa, puedes visualizar todos los programas pero solo podrás aplicar a los que cumplan con tu nivel de calificación.
                    </p>
                </div>
                @include('website.layouts.button_audio', ['target' => 'info_program_info'])
            </div>
        
            @if($programas_inscrito)                       
            <div class="container text-center mb-4">
                <div class="row justify-content-center">
                    <div class="col-8">
                        <h1 class="display-1">Estás inscrito en....</h1>
                    </div>
                </div>
            </div>            
            <div class="container-fluid text-center mb-4">
                <div class="row justify-content-center">
                    @foreach($programas_inscrito as $key => $program)
                        @if(isset($program->convocatoria_id) && date('Y-m-d', strtotime($program->fecha_cierre_convocatoria )) >= date('Y-m-d'))
                            <div class="col mb-4">
                                <ul class="">
                                    <li audio-tag="info_program_li_{{$key}}" class="">
                                        <a href="{{ route('company.program.show', ['id' => $program->convocatoria_id]) }}" class="tarjeta_info_programa">
                                            @if(date('Y-m-d', strtotime($program->fecha_cierre_convocatoria )) >= date('Y-m-d'))
                                                <h3>Registrado</h3>
                                            @else
                                                <h3>Registrado - Cerrado el {{ date('Y-m-d', strtotime($program->fecha_cierre_convocatoria )) }}</h3>
                                            @endif
                                            <div class="logo">
                                                <img src="{{ asset('storage/' . $program->logo) }}" alt="">
                                            </div>
                                            <div class="info">
                                                <div class="title">
                                                    <h2>{{ $program->nombre }}</h2>
                                                </div>
                                                <p>{{ $program->descripcion }}</p>
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
        
        

            
            <!--programas recomendados  titulo-->
            <div class="container text-center mb-4">
                <div class="row justify-content-center">
                    <div class="col-8">
                        <h1 class="display-1">Te recomendamos inscribirte en.....</h1>
                    </div>
                </div>
            </div>
            <!--programas recomendados-->
            <div class="container text-center mb-4">
                <div class="row justify-content-center"">
                    @foreach($programs_recommend as $key => $program)
                    @php($noencontrado = true)
                    @foreach($programas_inscrito as $key2 => $program2)                    
                    @if( $program->id == $program2->id )
                    @php($noencontrado = false)
                    @endif                                                                        
                    @endforeach
                    
                    @if($noencontrado) 
                    <div class="col mb-4">
                        <ul class="">
                            <li audio-tag="info_program_li_{{$key}}" class="">
                                <a href="{{route('company.program.show', [$program->id])}}" class="tarjeta_info_programa">
                                    <h3>Recomendado</h3>
                                    <div class="logo">
                                        <img src="{{ asset( 'storage/'.$program->logo ) }}" alt="">
                                    </div>
                                    <div class="info">
                                        <div class="title">
                                            <h2>{{$program->nombre}}</h2>
                                        </div>
                                        <p>
                                            {{$program->descripcion}}
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
            </div>

            <!--otros programas  titulo-->
            <div class="container text-center  mb-4">
                <div class="row justify-content-center"">
                    <div class="col-8">
                        <h1 class="display-1">...más programas.</h1>
                    </div>
                </div>
            </div>
            <!--otros programas tarjetas -->
            <div class="container-fluid text-center mb-4">
                <div class="row justify-content-center">
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
                                        <img src="{{ asset( 'storage/'.$program->logo ) }}" alt="">
                                    </div>
                                    <div class="info">
                                        <div class="title">
                                            <h2>{{$program->nombre}}</h2>
                                        </div>
                                        <p>
                                            {{$program->descripcion}}
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
            </div>


                    
                    
                    @foreach($programas_cerrados_recomendados as $key => $program)                    
                    
                    @php($noencontrado = true)
                    @foreach($programas_inscrito as $key2 => $program2)                    
                    @if( $program->convocatoria_id == $program2->convocatoria_id )
                    @php($noencontrado = false)
                    @endif                                                                        
                    @endforeach
                    
                    @if($noencontrado)                     
                    <div class="col  mb-4">
                        <ul class="">
                            <li audio-tag="info_program_li_{{$key}}" class="">
                                <a href="{{route('company.program.show', [$program->convocatoria_id])}}" class="tarjeta_info_programa">   
                                    <h3>Cerrado el {{date('Y-m-d', strtotime($program->fecha_cierre_convocatoria )) }}</h3>                                 
                                    <div class="logo">
                                        <img src="{{ asset( 'storage/'.$program->logo ) }}" alt="">
                                    </div>
                                    <div class="info">
                                        <div class="title">
                                            <h2>{{$program->nombre}}</h2>
                                        </div>
                                        <p>
                                            {{$program->descripcion}}
                                        </p>
                                        <div class="more">Ver más información</div>
                                    </div>
                                </a>
                                @include('website.layouts.button_audio', ['target' => 'info_program_li_'.$key])
                            </li>
                        </ul>
                    </div>         
                    @endif
                    
                    @endforeach
                    
                    
                    @foreach($programas_cerrados as $key => $program)                    
                    
                    @php($noencontrado = true)
                    @foreach($programas_inscrito as $key2 => $program2)                    
                    @if( $program->convocatoria_id == $program2->convocatoria_id )
                    @php($noencontrado = false)
                    @endif                                                                        
                    @endforeach
                    
                    @if($noencontrado)                     
                    <div class="col  mb-4">
                        <ul class="">
                            <li audio-tag="info_program_li_{{$key}}" class="">
                                <a href="{{route('company.program.show', [$program->convocatoria_id])}}" class="tarjeta_info_programa">   
                                    <h3>Cerrado el {{date('Y-m-d', strtotime($program->fecha_cierre_convocatoria )) }}</h3>                                 
                                    <div class="logo">
                                        <img src="{{ asset( 'storage/'.$program->logo ) }}" alt="">
                                    </div>
                                    <div class="info">
                                        <div class="title">
                                            <h2>{{$program->nombre}}</h2>
                                        </div>
                                        <p>
                                            {{$program->descripcion}}
                                        </p>
                                        <div class="more">Ver más información</div>
                                    </div>
                                </a>
                                @include('website.layouts.button_audio', ['target' => 'info_program_li_'.$key])
                            </li>
                        </ul>
                    </div>         
                    @endif
                    
                    @endforeach
                </div>
            </div>

        </div>
    </main>
    @include('website.layouts.helper')
</div>
@endsection

@section('js')
<script>
  $(document).ready(function () {
      $('header .programs').addClass('active');
  });
</script>
@endsection
