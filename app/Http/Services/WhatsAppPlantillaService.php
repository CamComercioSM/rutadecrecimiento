<?php

namespace App\Http\Services;

use App\Models\UnidadProductiva;
use App\Models\WhatsappTemplate;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppPlantillaService
{
    /**
     * Envía la plantilla de diagnóstico finalizado al completar un diagnóstico.
     * Plantilla: rutac_diagnostico_finalizado_1ro
     */
    public static function enviarDiagnosticoFinalizado(UnidadProductiva $unidadProductiva): bool
    {
        $plantillaName = 'rutac_diagnostico_finalizado_1ro';
        $plantilla = self::getPlantillaByName($plantillaName);

        if (!$plantilla) {
            Log::warning('WhatsApp: plantilla no encontrada', ['name' => $plantillaName]);
            return false;
        }

        $whatsappNumber = self::obtenerNumeroWhatsApp($unidadProductiva);
        if (!$whatsappNumber) {
            Log::warning('WhatsApp: sin número para unidad productiva', [
                'unidadproductiva_id' => $unidadProductiva->unidadproductiva_id,
            ]);
            return false;
        }

        $plantillaDatos = self::mapearDatosDesdeUnidadProductiva($unidadProductiva, $plantilla['expected_fields']);
        if ($plantillaDatos === null) {
            Log::warning('WhatsApp: faltan campos requeridos para plantilla', [
                'plantilla' => $plantillaName,
                'unidadproductiva_id' => $unidadProductiva->unidadproductiva_id,
            ]);
            return false;
        }

        return self::enviar(
            $whatsappNumber,
            $plantilla['name'],
            $plantilla['group_code'],
            $plantillaDatos
        );
    }

    /**
     * Obtiene la configuración de una plantilla por nombre.
     * Busca primero en la tabla whatsapp_templates; si no existe, usa config.
     *
     * @return array|null { name, group_code, expected_fields } o null
     */
    public static function getPlantillaByName(string $name): ?array
    {
        $template = WhatsappTemplate::where('name', $name)
            ->where('channel', 'whatsapp')
            ->first();

        if ($template) {
            return $template->toPlantillaConfig();
        }

        $plantillas = config('whatsapp_plantillas.plantillas', []);
        return $plantillas[$name] ?? null;
    }

    /**
     * Mapea los expected_fields de la plantilla a valores desde la unidad productiva
     * y modelos relacionados (usuario, etapa).
     *
     * @return array|null array [ key => value ] o null si falta un campo requerido
     */
    public static function mapearDatosDesdeUnidadProductiva(UnidadProductiva $unidadProductiva, array $expectedFields): ?array
    {
        $unidadProductiva->loadMissing(['usuario', 'etapa']);
        $map = self::getMapeoUnidadProductiva($unidadProductiva);
        $out = [];

        foreach ($expectedFields as $field) {
            $key = $field['key'] ?? $field;
            $required = $field['required'] ?? true;
            $keyStr = is_string($key) ? $key : ($field['key'] ?? '');
            $value = $map[$keyStr] ?? '';

            if ($required && (string) $value === '') {
                return null;
            }
            $out[$keyStr] = (string) $value;
        }

        return $out;
    }

    /**
     * Mapeo de keys de plantilla a atributos de UnidadProductiva / usuario / etapa.
     */
    protected static function getMapeoUnidadProductiva(UnidadProductiva $up): array
    {
        $usuario = $up->usuario;
        $etapa = $up->etapa;

        $nombreUsuario = $usuario
            ? trim(($usuario->name ?? '') . ' ' . ($usuario->lastname ?? ''))
            : ($up->name_legal_representative ?? '');

        return [
            'usuarioNOMBRE' => $nombreUsuario,
            'empresaRAZONSOCIAL' => $up->business_name ?? '',
            'etapaRUTAC' => $etapa ? $etapa->name : '',
        ];
    }

    /**
     * Obtiene el número WhatsApp del destinatario (unidad productiva o usuario).
     * Prioridad: mobile, telephone, contact_phone. Normalizado con código país 57.
     */
    public static function obtenerNumeroWhatsApp(UnidadProductiva $unidadProductiva): ?string
    {
        $raw = $unidadProductiva->mobile
            ?? $unidadProductiva->telephone
            ?? $unidadProductiva->contact_phone
            ?? null;

        if ($raw === null || (string) $raw === '') {
            return null;
        }

        return self::normalizarNumeroColombia((string) $raw);
    }

    /**
     * Normaliza número a solo dígitos con código país 57 (Colombia).
     */
    public static function normalizarNumeroColombia(string $numero): string
    {
        $digits = preg_replace('/\D/', '', $numero);
        $code = config('whatsapp_plantillas.default_country_code', '57');

        if (strlen($digits) === 10 && str_starts_with($digits, '3')) {
            return $code . $digits;
        }
        if (strlen($digits) === 12 && str_starts_with($digits, '57')) {
            return $digits;
        }
        if (strlen($digits) >= 10) {
            return $code . substr($digits, -10);
        }
        return $code . $digits;
    }

    /**
     * Envía la plantilla a la API.
     * Content-Type: application/x-www-form-urlencoded
     *
     * @param string $whatsappNumber Número con código país (ej: 573114158174)
     * @param string $plantillaNombre Nombre de la plantilla
     * @param string $plantillaGrupo group_code
     * @param array $plantillaDatos [ 'campo' => 'valor', ... ]
     */
    public static function enviar(
        string $whatsappNumber,
        string $plantillaNombre,
        string $plantillaGrupo,
        array $plantillaDatos
    ): bool {
        $url = config('whatsapp_plantillas.api_url'); // base + /enviarPlantillaWhatsAPP
        if (!$url) {
            Log::error('WhatsApp: WHATSAPP_API_URL no configurada en .env');
            return false;
        }

        $payload = [
            'whatsappNumber' => $whatsappNumber,
            'plantillaNombre' => $plantillaNombre,
            'plantillaGrupo' => $plantillaGrupo,
        ];
        foreach ($plantillaDatos as $key => $value) {
            $payload['plantillaDatos[' . $key . ']'] = $value;
        }

        try {
            // Sin proxy: evita que Guzzle use HTTP_PROXY/HTTPS_PROXY y falle contra 127.0.0.1
            $response = Http::asForm()
                ->timeout(15)
                ->withOptions(['proxy' => false])
                ->post($url, $payload);

            if ($response->successful()) {
                Log::info('WhatsApp plantilla enviada', [
                    'plantilla' => $plantillaNombre,
                    'to' => $whatsappNumber,
                ]);
                return true;
            }

            Log::error('WhatsApp API error', [
                'status' => $response->status(),
                'body' => $response->body(),
                'plantilla' => $plantillaNombre,
                'to' => $whatsappNumber,
            ]);
            return false;
        } catch (\Throwable $e) {
            Log::error('WhatsApp excepción', [
                'error' => $e->getMessage(),
                'plantilla' => $plantillaNombre,
                'to' => $whatsappNumber,
            ]);
            return false;
        }
    }
}
