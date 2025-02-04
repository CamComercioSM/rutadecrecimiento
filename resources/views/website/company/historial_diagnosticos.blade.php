@extends('website.layouts.main_dashboard')
@section('title','Ruta C Dashboard')
@section('description','')

@section('content')

    <div class="info c-dashboard">
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
                                        <b>Historial de diagnósticos</b>
                                    </h3>
        
                                    <hr class="my-4" >
                                    <p class="desc">
                                        
                                    </p>
        
                                </div>
    
                                @include('website.layouts.button_audio', ['target' => 'info_program_info'])
    
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="p-3 shadow bg-white mt-3">
                    <div class="row" >
                    
                        <div class="col-12 col-md-6">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th class="fw-bold">Fecha</th>
                                            <th class="fw-bold">Puntaje</th>
                                            <th class="fw-bold">Etapa</th>
                                            <th class="fw-bold">Acciones</th> <!-- Añadido para describir la columna de acciones -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($company->diagnosticos()->orderBy('fecha_creacion', 'desc')->get() as $Diag)
                                        <tr>
                                            <td>{{ $Diag->fecha_creacion }}</td>
                                            <td>{{ $Diag->resultado_puntaje }}</td>
                                            <td>{{ $Diag->etapa->name ?? 'Etapa no definida' }}</td>
                                            <td>
                                                <a class="btn btn-link" href="/historialDiagnosticos/{{ $Diag->resultado_id }}">
                                                    Detalles
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-6">
                            <br><br>          
                            @include('website.company.barra_historicos_diagnosticos') 
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
