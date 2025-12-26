<!DOCTYPE HTML>
<html lang="es">
<head>
    <title>@yield('title')</title>
    <meta charset="UTF-8"/>
    <meta name="description" content="@yield('description')"/>
    <meta name="keywords" content="@yield('keywords')"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0"/>
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ URL::current() }}"/>
    @yield('meta')
    <link rel="icon" type="image/png" href="{!! URL::asset('/img/commons/favicon.png') !!}">
    <link rel="apple-touch-icon" href="{!! URL::asset('/img/commons/favicon.png') !!}">           
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{!! URL::asset('/css/style.css?v=07-01-21') !!}" type="text/css" media="screen"/>

        @yield('css')
        
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://kit.fontawesome.com/01ae7d183b.js" crossorigin="anonymous"></script> 
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        
</head>
<body>
<div id="page">
    <div id="center">
        @yield('content')
    </div>
    @include('website.layouts.alert')
</div>
@yield('js')
<script>
    // Boton para lectura de texto en voz
    $('.c-audio-action').click(function (e) {
        var target = $(this).attr('audio-target');
        var audio = document.querySelector('[audio-tag="' + target + '"]');
        var texto = audio.textContent;

        if ('speechSynthesis' in window) {
            const synth = window.speechSynthesis;

            // Verificar si ya se está reproduciendo el mismo texto
            if (synth.speaking) {
                synth.cancel();
            } else {
                const utterance = new SpeechSynthesisUtterance(texto);
                synth.speak(utterance);
            }
        } else {
            alert('Navegador no compatible');
        }
    });
</script>







@include('website.mantenimiento.modal_aviso') 

        <!-- <a href="https://wa.me/573218150243?text=Me%20gustaría%20saber%20........." class="whatsapp" target="_blank"> <i class="fa fa-whatsapp whatsapp-icon"></i></a> -->




<script>
    var url = 'https://wati-integration-prod-service.clare.ai/v2/watiWidget.js?30967';
    var s = document.createElement('script');
    s.type = 'text/javascript';
    s.async = true;
    s.src = url;
    var options = {
        "enabled": true,
        "chatButtonSetting": {
            "backgroundColor": "#00e785",
            "ctaText": "Escríbenos 24/7",
            "borderRadius": "25",
            "marginLeft": "0",
            "marginRight": "25",
            "marginBottom": "25",
            "ctaIconWATI": false,
            "position": "left"
        },
        "brandSetting": {
            "brandName": "RutaC CamComercoSM",
            "brandSubTitle": "undefined",
            "brandImg": "https://cdnsicam.net/img/rutac/rutac-whatsapp-cuadrado.png",
            "welcomeText": "Bienvenid@s, ¿Cómo podemos ayudarte?\n",
            "messageText": "Hola, me puedes ayudar con ......... [app.rutadecrecimiento.com]",
            "backgroundColor": "#00e785",
            "ctaText": "Escríbenos 24/7",
            "borderRadius": "25",
            "autoShow": false,
            "phoneNumber": "573218150243"
        }
    };
    s.onload = function() {
        CreateWhatsappChatWidget(options);
    };
    var x = document.getElementsByTagName('script')[0];
    x.parentNode.insertBefore(s, x);
</script>


</body>
</html>
