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
                        @php $whatsapp = optional($footer)->whatsapp ?? null; @endphp
                        @if (!empty($whatsapp))
                            <span class="block font-s-small">
                                <a class="font-s-small"
                                   href="https://wa.me/{{ $whatsapp }}?text=Me%20gustar%C3%ADa%20saber%20.........">
                                    <img src="{{ asset('img/icons/whatsapp.png') }}" alt="WhatsApp"
                                         style="max-width: 32px; float: left;" />
                                </a>
                                WhatsApp {{ $whatsapp }}
                            </span>
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



<div id="widget-whatsapp-raiz"></div>
<script>
    window.CONFIGURACION_WIDGET_WHATSAPP = {
        telefono: "573218150243",
        posicion: "izquierda-abajo",           // ver lista de posiciones más abajo
        textoBoton: "¿necesitas ayuda?",
        mensajePredeterminado: "Hola, necesito más informacion de.....",
        nombreMarca: "RutaC CamComercoSM",
        subtituloMarca: "Asesor Ruta C",
        textoBienvenida: "¡Hola! Cuéntanos en qué podemos apoyarte 😊",
        abrirAutomaticamente: false,
        imagenMarca: "https://cdnsicam.net/img/logo-2026-activa-tu-crecimiento.png",
        // cualquier campo que omitas usa el valor por defecto del widget
    };
</script>
<script src="https://cdnsicam.net/js/whatsapp-widget.js"></script>
