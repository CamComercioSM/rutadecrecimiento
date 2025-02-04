@extends('website.layouts.main_dashboard')
@section('title','Ruta C Dashboard')
@section('description','')

@section('content')

    <div class="c-dashboard">
        @include('website.layouts.header_company')
        
        <main>
            <div id="dashboard" class="container" >

                <div class="p-3 shadow bg-white mt-3">
                    <div class="row">
                        <div class="col col-md">
    
                            <div class="company-card text-center p-3">
                                <div class="card-body">
                                    <img height="100" style="margin: 0 auto;"
                                        src="
                                            @if(!empty($company->logo))
                                               {{ asset( $company->logo) }}
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
                            <div class="w-100" >
    
                                <div audio-tag="info_program_info" >
                                    <h3>
                                        <b>Detalle diagnósticos</b>
                                    </h3>
        
                                    <hr class="my-4" >
                                    <p class="desc">
                                        <b>Fecha:</b> {{$diagnostico->fecha_creacion}} <br>
                                        <b>Puntaje:</b> {{$diagnostico->resultado_puntaje}} <br>
                                        <b>Etapa:</b> {{$diagnostico->etapa->name ?? 'Etapa no definida'}}
                                    </p>
        
                                </div>
    
                                @include('website.layouts.button_audio', ['target' => 'info_program_info'])
    
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <div class="p-3 shadow bg-white mt-3">
                    <div class="row" >
                                        
                        <div class="col-12">
                            @include('website.company.radar_diagnosticos') 
                        </div>


                        <div class="col-12 col-md-12" >
                            <hr class="my-4" >

                            <h2 class="mb-4">
                                <b>Listado de preguntas</b>

                                <a class="btn btn-sm btn-info" style="float: right;" href="/exportarPreguntasDiagnostico/{{$diagnostico->resultado_id}}">
                                    Exportar
                                </a>
                            </h2>

                            <div class="table-responsive border m-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>                                  
                                            <th class="fw-bold">Pregunta</th>
                                            <th class="fw-bold">Respuesta</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($diagnostico->respuestas as $resp)
                                            <tr>                                         
                                                <td class="border-0">
                                                    {{ $resp->pregunta->pregunta_titulo }}
                                                </td>
                                                <td class="border-0">
                                                    {{ $resp->diagnosticorespuesta_valor }}
                                                </td>
                                            </tr>
                                        @endforeach                                
                                    </tbody>
                                </table>
                            </div>
                        </div>


                        <div class="col-12 text-center mt-4">

                            <a class="btn btn-link" href="/dashboard" class="btn btn-primary">
                                Regresar al Dashboard
                            </a>
                            
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

@endsection
