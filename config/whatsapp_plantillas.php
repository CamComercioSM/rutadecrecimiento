<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Base URL API WhatsApp (reutilizable en varias partes)
    |--------------------------------------------------------------------------
    | En .env: WHATSAPP_API_URL=https://rutac.apisicam.net/
    | Se construye la URL completa por endpoint.
    */
    'api_base_url' => rtrim(env('WHATSAPP_API_URL', 'https://rutac.apisicam.net'), '/'),

    'api_url' => rtrim(env('WHATSAPP_API_URL', 'https://rutac.apisicam.net'), '/') . '/enviarPlantillaWhatsAPP',

    /*
    |--------------------------------------------------------------------------
    | Plantillas por nombre (name) - compatibles con rutac_admin
    |--------------------------------------------------------------------------
    | name: nombre de la plantilla en el proveedor WhatsApp.
    | group_code: plantillaGrupo enviado a la API.
    | expected_fields: array de ['key' => string, 'required' => bool]. Las keys
    |   se mapean a datos de la unidad productiva (ver WhatsAppPlantillaService).
    */
    'plantillas' => [
        'rutac_diagnostico_finalizado_1ro' => [
            'name' => 'rutac_diagnostico_finalizado_1ro',
            'group_code' => 'DIAGNOSTICO_REALIZADO',
            'expected_fields' => [
                ['key' => 'usuarioNOMBRE', 'required' => true],
                ['key' => 'empresaRAZONSOCIAL', 'required' => true],
                ['key' => 'etapaRUTAC', 'required' => true],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Código de país por defecto (Colombia)
    |--------------------------------------------------------------------------
    */
    'default_country_code' => '57',
];
