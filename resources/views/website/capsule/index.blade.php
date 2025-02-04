@extends('website.layouts.main_dashboard')
@section('title','Ruta C Dashboard')
@section('description','')

@section('content')
    <div class="c-dashboard">
        @include('website.layouts.header_company')
        <main>
            <div id="capsules" class="container">

                <div class="p-4 shadow bg-white mt-3">
                    <div class="row">
                        <div class="col col-md">
    
                            <div class="company-card text-center p-3">
                                <div class="card-body">
                                    <img height="150" style="margin: 0 auto;"
                                        src="
                                            @if(!empty($company->logo))
                                            {{ asset('' . $company->logo) }}
                                            @else
                                                @if($company->unidadtipo_id == 1)
                                                    https://rutadecrecimiento.com/img/registro/idea_negocio.png
                                                @elseif($company->unidadtipo_id == 2)
                                                    https://rutadecrecimiento.com/img/registro/informal_negocio_en_casa.png
                                                @elseif($company->unidadtipo_id == 3)
                                                    https://rutadecrecimiento.com/img/registro/registrado_fuera_ccsm.png
                                                @elseif($company->unidadtipo_id == 4)
                                                    https://rutadecrecimiento.com/img/registro/registrado_ccsm.png
                                                @endif
                                            @endif
                                        " 
                                        class="company-image" alt="Imagen de la empresa">
                            
                                
                                    <h5 class="card-title pt-4"> <b>{{$company->business_name}}</b> </h5>
                                    <p class="card-text">NIT: {{$company->nit}}</p>
                                </div>
                            </div>
    
                        </div>
                        <div class="col col-md-8 d-flex align-items-center">
                            <div class="w-100">
    
                                <div audio-tag="info_program_info" >
                                    <h3>
                                        Te encuentras en la etapa de <b>{{ $nombreEtapa }}</b>
                                    </h3>
        
                                    <hr class="my-4" >
                                    <p class="desc">
                                        Teniendo en cuenta el diagnóstico de tu empresa, te recomendamos las siguientes cápsulas de capacitación
                                    </p>
                                </div>
    
                                @include('website.layouts.button_audio', ['target' => 'info_program_info'])
    
                            </div>
                        </div>
                    </div>
                </div>

                <div class="wrap wrap-large textl">
                    
                    <ul class="mt-40">
                        @foreach($capsules as $capsule)
                            <li>
                                <a class="h-100" href="{{$capsule->url_video}}" target="_blank">
                                    <div class="img" style="background-image: url('{{ asset( ''.$capsule->imagen ) }}')"></div>
                                    <div class="info">
                                        <h2>{{$capsule->nombre}}</h2>
                                        <p>
                                            {{$capsule->descripcion}}
                                        </p>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </main>
        @include('website.layouts.helper')
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('header .capsules').addClass('active');
        });
    </script>
@endsection
