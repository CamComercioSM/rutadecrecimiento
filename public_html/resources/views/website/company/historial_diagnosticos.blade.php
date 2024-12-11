@extends('website.layouts.main_dashboard')
@section('title','Ruta C Dashboard')
@section('description','')

@section('content')

    <div class="c-dashboard">
        @include('website.layouts.header_company')
        <main>
            <div class="my-5" style="width: 90%;">
                
                <h2 class="mb-4">Historial de diagnósticos</h2>

                <div class="row" >
                
                    <div class="col-12 col-md-6">
                        <h4>Historial de Diagnosticos</h4>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Puntaje</th>
                                    <th scope="col">Etapa</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($company->diagnosticos as $Diag)
                                <tr>
                                    <th scope="row">{{$Diag->fecha_creacion}}</th>
                                    <td>{{$Diag->resultado_puntaje}}</td>
                                    <td>{{ $Diag->etapa_nombre  ?? '' }}</td>
                                    <td>
                                        <a class="btn btn-link" href="/historialDiagnosticos/{{$Diag->resultado_id}}">
                                            Detalles
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="col-12 col-md-6">          
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
