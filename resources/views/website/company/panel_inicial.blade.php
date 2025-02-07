
<div class="p-4 shadow mt-3">
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
                    <!-- Condicional para mostrar el NIT solo para unidadtipo_id 3 o 4 -->
        @if($company->unidadtipo_id == 3 || $company->unidadtipo_id == 4)
        <p class="card-text">NIT: {{$company->nit}}</p>
    @endif
                </div>
            </div>

        </div>
        <div class="col col-md-8 d-flex align-items-center">
            <div class="w-100">
                <ul class="w-100">
                    @foreach($stages as $stage)    
                    <li class="etapaAnimacionEntrada {{$stage->etapa_id == $company->etapa_id ? 'active' : null}} {{ $stage->etapa_id < $company->etapa_id ? 'completed' : null }}" style="animation-delay: {{$stage->etapa_id - 1 }}s; z-index: {{ ($stage->etapa_id == $company->etapa_id ? 999 : 99) - $stage->etapa_id}};" >
                        <button data-fancybox="dialog" data-src="#stage-{{$stage->etapa_id}}"
                                @if($stage->etapa_id == 1) data-step="8"
                            data-intro="Puedes hacer clic sobre las etapas para obtener mayor información" @endif>
                            <img src="{{asset('img/content/'.$stage->image)}}" alt="Ruta C">
                            <h4 class="mayus">{{$stage->name}}</h4>
                        </button>
                    </li>
                    @endforeach
                </ul>

                <hr class="my-4" >

                <div>
                    Clasificación basada en el último diagnóstico <b>[{{$company->diagnosticos->last()->fecha_creacion}}]</b> con un <b>puntaje
                    de {{number_format($company->diagnosticos->last()->resultado_puntaje, 2, ',', ',')}}</b>.
                </div>
                
                @if($activarDIAGVOLUNTARIO)
                 <div>¿Quieres realizar el diagnostico de madurez nuevamente? <a style="font-size: 1rem;" href="{{route('company.diagnostic', [$company->id])}}">click aquí</a></div>
                @endif

                <a style="font-size: 1rem;" href="{{route('company.historialDiagnosticos')}}">
                    Ver historial de diagnósticos
                </a>
            </div>
        </div>
    </div>
</div>