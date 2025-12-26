<footer class="@yield('header-class')">
    <div class="social-media">
        <ul>
            <li>
                <div class="h6 font-s-medium">Síguenos en</div>
            </li>
            <li>
                <a href="https://web.facebook.com/camcomercioSM/?_rdc=1&_rdr">
                    <img src="{{ asset('img/icons/facebook.svg') }}" alt="Facebook">
                </a>
            </li>
            <li>
                <a href="https://www.instagram.com/camcomerciosm/">
                    <img src="{{ asset('img/icons/instagram.svg') }}" alt="Instagram">
                </a>
            </li>
            <li>
                <a href="https://www.linkedin.com/company/camcomerciosm/mycompany/">
                    <img src="{{ asset('img/icons/linkedin.svg') }}" alt="linkedin">
                </a>
            </li>
            <li>
                <a href="https://twitter.com/i/flow/login?redirect_after_login=%2FCamComercioSM">
                    <img src="{{ asset('img/icons/twitter.svg') }}" alt="twitter">
                </a>
            </li>
            <li>
                <a href="https://www.youtube.com/CamaraComercioSantaMarta">
                    <img src="{{ asset('img/icons/youtube.svg') }}" alt="Youtube">
                </a>
            </li>
        </ul>
    </div>
    <div class="wrap wrap-medium">
        <div class="footer">
            @if (isset($footer->footer_logo_ally) && !empty($footer->footer_logo_ally))
                <a href="https://www.ccsm.org" target="_blank" aria-label="Camara de comercio (opens in a new tab)">
                    <img src="{{ asset('' . $footer->footer_logo_ally) }}" alt="Camara comercio">
                </a>
            @endif
            @if (isset($footer->footer_logo_rutac) && !empty($footer->footer_logo_rutac))
                <div class="logo">
                    <img src="{{ asset('' . $footer->footer_logo_rutac) }}" alt="Ruta C Logo footer">
                </div>
            @endif
            <div class="info">
                <ul>
                    <li class="textl">
                        <span class="font-s-small">Más información en</span>
                        @if (isset($footer->whatsapp) && !empty($footer->whatsapp))
                            {{-- <span class="block font-s-small"> <a class="font-s-small"
                                    href="https://wa.me/{{ $footer->whatsapp }}?text=Me%20gustar%C3%ADa%20saber%20........."><img
                                        src="{{ asset('img/icons/whatsapp.png') }}" alt="WhatsApp"
                                        style="max-width: 32px; float: left;" /></a> WhatsApp {{ $footer->whatsapp }}
                            </span> --}}
                        @endif
                        @if (isset($footer->footer_ally_page) && !empty($footer->footer_ally_page))
                            <a class="font-s-small" href="https://{{ $footer->footer_ally_page }}" target="_blank"
                                aria-label="{{ $footer->footer_ally_page }} (opens in a new tab)">{{ $footer->footer_ally_page }}</a>
                        @endif
                        @if (isset($footer->footer_number_contact) && !empty($footer->footer_number_contact))
                            <span class="block font-s-small">Llámanos a {{ $footer->footer_number_contact }}</span>
                        @endif
                        @if (isset($footer->footer_email_contact) && !empty($footer->footer_email_contact))
                            <span class="block font-s-small">Escríbenos a {{ $footer->footer_email_contact }}</span>
                        @endif
                        @if (isset($footer->footer_address) && !empty($footer->footer_address))
                            <p class="font-s-small">Dirección: {{ $footer->footer_address }}@if (isset($footer->ubicacion_ciudad) && !empty($footer->ubicacion_ciudad))
                                    <br />{{ $footer->ubicacion_ciudad }}
                                @endif
                            </p>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
        <div class="pp mt-40">
            <ul>
                @foreach ($links as $link)
                    @if ($link->type == 0)
                        <li>
                            <a class="font-s-small" href="{{ $link->value }}" target="_blank"
                                aria-label="{{ $link->name }} (opens in a new tab)">{{ $link->name }}</a>
                        </li>
                    @else
                        <li>
                            <a class="font-s-small" href="{{ asset('' . $link->value) }}" target="_blank"
                                aria-label="{{ $link->name }} (opens in a new tab)">{{ $link->name }}</a>
                        </li>
                    @endif
                @endforeach
                <li>
                    <a class="font-s-small" href="{{ route('site.map') }}" target="_blank"
                        aria-label="Mapa de sitio (opens in a new tab)">Mapa de sitio</a>
                </li>
            </ul>
        </div>
    </div>
</footer>


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
            "marginRight": "20",
            "marginBottom": "20",
            "ctaIconWATI": false,
            "position": "right"
        },
        "brandSetting": {
            "brandName": "RutaC CamComercoSM",
            "brandSubTitle": "undefined",
            "brandImg": "https://cdnsicam.net/img/rutac/rutac-whatsapp-cuadrado.png",
            "welcomeText": "Bienvenid@s, ¿Cómo podemos ayudarte?\n",
            "messageText": "Hola, me gustaria saber mas de {{ page_title }} {{ page_link }}",
            "backgroundColor": "#00e785",
            "ctaText": "Escríbenos 24/7",
            "borderRadius": "25",
            "autoShow": true,
            "phoneNumber": "573218150243"
        }
    };
    s.onload = function() {
        CreateWhatsappChatWidget(options);
    };
    var x = document.getElementsByTagName('script')[0];
    x.parentNode.insertBefore(s, x);
</script>
