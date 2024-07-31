@extends('website.layouts.main')
@section('title',$section->seo_title)
@section('description',$section->seo_description)

@section('content')


    <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.css"/>
    <div id="home">
        <section class="banner swiper" tabindex="4">
            <ul class="swiper-wrapper">
                @foreach($banners as $banner)
                    <li class="swiper-slide" style="background-image: url('{{ asset('storage/'.$banner->image) }}')">
                        <a href="{{ $banner->url }}" target="_blank">
                            <div class="content textl">
                                <h2>{{ $banner->title }}</h2>
                                <p class="mt-10">{{ $banner->description }}</p>
                                <button class="button button-primary button-small mt-20">{{ $banner->text_button }}</button>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
            <div class="swiper-pagination"></div>
        </section>
        <section class="video margin-section">
            <h2 class="c-title-1 wrap-smaller margin-center" tabindex="5" audio-tag="seo-h1">
                {{$section->h1}}
            </h2>
            @include('website.layouts.button_audio', ['target' => 'seo-h1'])
            <div class="wrap">
                <div class="play margin-center box pad-20 mt-40" tabindex="6">
                    <div class="videoWrapper">
                        <iframe src="https://www.youtube.com/embed/{{ \App\helpers::getYouTubeVideoID($section->video_url) }}" title="Ruta C - Etapas" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                </div>
                <p class="mt-30 font-s-large" tabindex="7" audio-tag="seo-description">
                    {{$section->seo_description}}
                </p>
                @include('website.layouts.button_audio', ['target' => 'seo-description'])
                <a href="{{ route('register') }}" class="mt-30 block">
                    <button class="button button-primary margin-center" tabindex="8">Regístrate</button>
                </a>
            </div>
        </section>
        <section class="company margin-section">
            <div class="wrap wrap-small">
                <div audio-tag="histories">
                    <h2 class="c-title-1 bold" tabindex="9">{{ $data->histories_title }}</h2>
                    <p class="mt-20 margin-center font-s-large" tabindex="10">
                        {{ $data->histories_description }}
                    </p>
                </div>
                @include('website.layouts.button_audio', ['target' => 'histories'])
                <ul class="mt-40">
                    @foreach($histories as $history)
                        <li style="background-image: url('{{ asset('storage/'.$history->image) }}')" tabindex="11">
                            <a data-fancybox data-type="video" href="{{ $history->video_url }}">
                                <div class="image"></div>
                                <div class="name">
                                    <p class="font-s-medium" >{{ $history->name }}</p>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
        <section class="briefcase margin-section">
            <div class="wrap wrap-medium" style="background-image: url('{{ asset('storage/'.$data->discover_bg_image) }}')">
                <p tabindex="12">{{ $data->discover_title }}</p>
                <ul>
                    <li>
                        <a href="{{ $data->discover_button_1_url }}">
                            <button class="button button-primary" tabindex="13"> {{ $data->discover_button_1_label }}</button>
                        </a>
                    </li>
                    <li>
                        <a href="{{ $data->discover_button_2_url }}">
                            <button class="button button-secundary" tabindex="14">{{ $data->discover_button_2_label }}</button>
                        </a>
                    </li>
                </ul>
            </div>
        </section>
    </div>
    
@include('website.mantenimiento.modal_aviso') 

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
    <script>
        var swiper = new Swiper(".swiper", {
            loop: true,
            speed: 1000,
            loop: true,
            autoplay: {
                delay: 6000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                dynamicBullets: true,
                clickable: true,
            },
        });
    </script>
    
@endsection
