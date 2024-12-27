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
        <li class="etapaAnimacionEntrada {{$stage->etapa_id == $company->etapa_id ? 'active' : null}} {{ $stage->etapa_id < $company->etapa_id ? 'completed' : null }}" style="animation-delay: {{$stage->etapa_id - 1 }}s;  z-index: {{99 - $stage->etapa_id}};" >
            <button data-fancybox="dialog" data-src="#stage-{{$stage->etapa_id}}"
                    @if($stage->etapa_id == 1) data-step="8"
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
        <br>
        <a class="profile" href="{{route('company.historialDiagnosticos')}}">
            Ver historial de diagnósticos
        </a>
</div>

@if($activarDIAGVOLUNTARIO)
<div>¿Quieres realizar el diagnostico de madurez nuevamente? <a href="{{route('company.diagnostic', [$company->id])}}">click aquí</a></div>
@endif

<hr style="margin: 25px 0px;"/>

<div class="container text-center">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('website.company.radar_diagnosticos') 
        </div>
    </div>
</div>