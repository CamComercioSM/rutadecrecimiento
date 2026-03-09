<?php

return [
    /*
    |--------------------------------------------------------------------------
    | API WhatsApp interna (sin bearer)
    |--------------------------------------------------------------------------
    | En .env: WHATSAPP_API_URL=https://rutac.apisicam.net
    */
    'api_base_url' => rtrim(env('WHATSAPP_API_URL', 'https://rutac.apisicam.net'), '/'),

    'api_url' => rtrim(env('WHATSAPP_API_URL', 'https://rutac.apisicam.net'), '/') . '/enviarPlantillaWhatsAPP',
];

