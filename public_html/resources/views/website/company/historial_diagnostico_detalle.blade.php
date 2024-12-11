@extends('website.layouts.main_dashboard')
@section('title','Ruta C Dashboard')
@section('description','')

@section('content')

    <div class="c-dashboard">
        @include('website.layouts.header_company')
        <main>
            <div class="my-5" style="width: 90%;">
                
                <h2 class="mb-4" style="font-size: 2rem; margin-bottom: 2rem;">
                    Detalle diagnósticos
                </h2>

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
                                        {{ $diagnostico->etapa->name ?? 'Etapa no definida' }}
                                    </td>
                                </tr>                            
                            </tbody>
                        </table>
    
                    </div>
                    
                    <div class="col-12">
                        @include('website.company.radar_diagnosticos') 
                    </div>


                    <div class="col-12 col-md-12" >

                        <br><br>
                        
                        <h2>
                            <b>Listado de preguntas</b>

                            <a class="btn btn-sm btn-info" style="float: right;" href="/exportarPreguntasDiagnostico/{{$diagnostico->resultado_id}}">
                                Exportar
                            </a>
                        </h2>

                        <br><br>

                       <div class="border m-0">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                  
                                        <th>Pregunta</th>
                                        <th>Respuesta</th>
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
        </main>
    </div>

@endsection
