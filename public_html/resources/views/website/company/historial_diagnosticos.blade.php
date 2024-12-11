@extends('website.layouts.main_dashboard')
@section('title','Ruta C Dashboard')
@section('description','')

@section('content')

    <div class="info c-dashboard">
        @include('website.layouts.header_company')
        <main>
            <div class="my-5" style="width: 90%;">
                
                <h1 class="mt-10" style="font-size: 2rem; margin-bottom: 2rem;">
                    Historial de diagnósticos
                </h1>

                <div class="row" >
                
                    <div class="col-12 col-md-6">
                        
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Puntaje</th>
                                    <th scope="col">Etapa</th>
                                    <th scope="col">Acciones</th> <!-- Añadido para describir la columna de acciones -->
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
        </main>
    </div>

@endsection
