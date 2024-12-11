<h2>Bienvenido</h2>
<h3 class="font-w-700 mt-20">{{$company->business_name}}</h3>
<h1 class="mt-10">¿Qué harás hoy para que tu negocio siga creciendo?</h1>
<br />
<h4 class="mt-40">Estás en la etapa:</h4>
<br />
<br />
<br />
<div class="progress mt-20" data-step="7"
     data-intro="En esta opción puedes visualizar la etapa en la cual se encuentra tu empresa en el proceso de Ruta C">
    <ul>
        @foreach($stages as $stage)    
        <li class=" etapaAnimacionEntrada {{$stage->etapa_id == $company->etapa_id ? 'active' : null}}{{ $stage->etapa_id < $company->etapa_id ? 'completed' : null }}" style="animation-delay: {{$stage->id - 1 }}s;  z-index: {{99 - $stage->id}}  " >
            <button data-fancybox="dialog" data-src="#stage-{{$etapa_id->id}}"
                    @if($etapa_id->id == 1) data-step="8"
                data-intro="Puedes hacer clic sobre las etapas para obtener mayor información" @endif>
                <img src="{{asset('img/content/'.$stage->image)}}" alt="Ruta C">
                <h4 class="mayus">{{$stage->name}}</h4>
            </button>
        </li>
        @endforeach
    </ul>
</div>
<div class="score">
    Clasificación basada en el último diagnóstico <b>[{{$company->diagnosticos->last()->fecha_creacion}}]</b> con un <b>puntaje
        de {{number_format($company->diagnosticos->last()->resultado_puntaje, 2, ',', ',')}}</b>.
</div>

@if($activarDIAGVOLUNTARIO)
<div>¿Quieres realizar el diagnostico de madurez nuevamente? <a href="{{route('company.diagnostic', [$company->id])}}">click aquí</a></div>
@endif

<hr style="margin: 25px 0px;"/>


<div class="container text-center">
    <div class="row">
        <div class="col-md-8">
            @include('website.company.radar_diagnosticos') 
        </div>
        <div class="col-6 col-md-4">
            <h4 class="" >Historial de Diagnosticos</h4>

            <a class="profile" href="{{route('company.historialDiagnosticos')}}">
                Ver
            </a>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Fecha</th>
                        <th scope="col">Puntaje</th>
                        <th scope="col">Etapa</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($company->diagnosticos as $Diag)
                    @php
                    
                @endphp
                    <tr>
                        <th scope="row">{{$Diag->fecha_creacion}}</th>
                        <td>{{$Diag->resultado_puntaje}}</td>
                        <td>{{ $Diag->etapa_nombre ?? '' }}</td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
            <hr />            
            @include('website.company.barra_historicos_diagnosticos') 
        </div>
    </div>
</div>