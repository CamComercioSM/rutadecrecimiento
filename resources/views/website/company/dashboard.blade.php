@extends('website.layouts.main_dashboard')
@section('title','Ruta C Dashboard')
@section('description','')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intro.js/5.1.0/introjs.min.css"/>
<style>
.slick-track{
    height: 460px;
    padding: 2rem 0;
}
.slick-prev:before, 
.slick-next:before{
    color: black !important;
    font-size: 2rem;
}
.slick-next{
  right: -15px;
}
</style>

<div class="c-dashboard">
    @include('website.layouts.header_company')
    <main>
        <div id="dashboard">
            <div class="wrap wrap-large">
                <div class="info">
                    @include('website.company.panel_inicial') 

                    <div class="p-4">
                        <h4>
                            <b>Programas abiertos</b>
                        </h4>
                        <div class="row carrucelProgramas">

                           @foreach($programs as $program)
                            <div class="col d-flex align-items-stretch">
                                <a class="card shadow h-100 m-3" title="Ver detalles" href="{{ route('company.program.show', ['id' => $program->convocatoria_id]) }}" >
                                                                        
                                    <img 
                                    src="{{ asset('/' . $program->logo) }}" 
                                    class="card-img-top" 
                                    alt="{{$program->nombre}}" 
                                    style="object-fit: cover; width: 100%; height: 200px;">
                                                                    <div class="card-body overflow-auto">
                                        <h5 class="card-title">
                                            <b>{{$program->nombre}}</b>
                                        </h5>
                                        <div class="card-text mb-2" style="font-size: 1rem; color: black;">
                                            {{$program->descripcion}}
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @endforeach

                        </div>
                    </div>

                    <div class="p-4">
                        <h4>
                            <b>Teniendo en cuenta el diagnóstico de tu empresa, te recomendamos las siguientes cápsulas de capacitación</b>
                        </h4>
                        <div class="row carrucelCapculas">

                           @foreach($capsulas as $capsule)
                            <div class="col d-flex align-items-stretch">
                                <a class="h-100" href="{{$capsule->url_video}}" target="_blank">
                                <div class="card shadow h-100 m-3" >
                                    <img src="{{ asset( 'storage/'.$capsule->imagen ) }}" class="card-img-top" alt="{{$capsule->nombre}}">
                                    <div class="card-body overflow-auto">
                                        <h5 class="card-title">
                                            
                                            <b>{{$capsule->nombre}}</b>
                                        </h5>
                                        <div class="card-text mb-2" style="font-size: 1rem; color: black;">
                                            {{$capsule->descripcion}}

                                        </div>
                                    </div>
                                </div>
                            </a>
                            </div>
                            @endforeach

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/intro.js/5.1.0/intro.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

@foreach($stages as $stage)
<div id="stage-{{$stage->etapa_id}}" class="hidden c-stage-description">
    <h2 class="bold textl">{{$stage->name}}</h2>
    <p class="mt-20">{!! nl2br($stage->description) !!}</p>
</div>
@endforeach

<!--una encuesta sobre el producto-->
<hr />
<hr />
@if($company->show_poll == 1)
<div id="dashboard-company-comments" class="hidden">
    <h2 class="size-xl color-2 font-w-700">Bienvenido al Panel para empresas de Ruta C</h2>
    <h3 class="size-l color-2 font-w-700 mt-20">¡Agradecemos tu dedicación en completar el proceso de
        registro!</h3>
    <p class="mt-20">
        Si deseas puedes dejar algún comentario adicional que nos ayude a entender más aspectos sobre tu negocio
    </p>
    <form>
        <div class="row">
            <textarea class="mt-20"></textarea>
        </div>
        <ul>
            <li>
                <button data-fancybox-close class="button button-secundary">OMITIR ESTE PASO</button>
            </li>
            <li>
                <input type="submit" name="send" value="ENVIAR COMENTARIOS" class="button button-primary">
            </li>
        </ul>
    </form>
</div>


@php( \App\Http\Services\UnidadProductivaService::disablePoll() )
@endif

@include('website.layouts.helper')

<script>    
    $('.carrucelCapculas').slick({
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        autoplaySpeed: 5000,
        autoplay: true,
        responsive: [
            {
                breakpoint: 767,
                settings: { slidesToShow: 1 }
            }
        ]
    }); 

    $('.carrucelProgramas').slick({
        slidesToShow: 2,
        slidesToScroll: 3,
        infinite: true,
        autoplaySpeed: 5000,
        autoplay: true,
        responsive: [
            {
                breakpoint: 767,
                settings: { slidesToShow: 1 }
            }
        ]
    }); 

</script>


@endsection
