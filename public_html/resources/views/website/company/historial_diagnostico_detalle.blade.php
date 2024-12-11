@extends('website.layouts.main_dashboard')
@section('title','Ruta C Dashboard')
@section('description','')

@section('content')

    <div class="c-dashboard">
        @include('website.layouts.header_company')
        <main>
            <div class="my-5" style="width: 90%;">
                
                <h2 class="mb-4">Detalle diagnósticos</h2>

                <div class="row" >
                  
                    <div class="col-12 col-md-12">
                        <table class="table table-bordered border">
                            <tbody>
                                <tr>
                                    <td scope="row">
                                        Fecha: <br>
                                        {{$diagnostico->fecha_creacion}}
                                    </td>
                                    <td>
                                        Puntaje: <br>
                                        {{$diagnostico->resultado_puntaje}}
                                    </td>
                                    <td>
                                        Etapa: <br>
                                        {{ $diagnostico->etapa_nombre ?? '' }}
                                    </td>
                                </tr>                            
                            </tbody>
                        </table>
    
                    </div>
                    
                    <div class="col-12">
                        @include('website.company.radar_diagnosticos') 
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
