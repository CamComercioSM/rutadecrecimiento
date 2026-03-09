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
     * Usa la plantilla de categoría 1 en la tabla whatsapp_templates
     * (name y group_code vienen desde BD).
     */
    public static function enviarDiagnosticoFinalizado(UnidadProductiva $unidadProductiva): bool
    {
        // Tomamos la plantilla activa de categoría 1 (Diagnóstico), canal whatsapp
        $template = WhatsappTemplate::where('category_id', 1)
            ->where('channel', 'whatsapp')
            // Si la columna is_active existe pero viene en null, igual la aceptamos.
            ->where(function ($q) {
                $q->whereNull('is_active')->orWhere('is_active', 1);
            })
            ->first();

        if (!$template) {
            Log::warning('WhatsApp: plantilla categoría 1 no encontrada en whatsapp_templates');
            return false;
        }

        $expectedFields = $template->expected_fields ?? [];

        $whatsappNumber = self::obtenerNumeroWhatsApp($unidadProductiva);
        if (!$whatsappNumber) {
            Log::warning('WhatsApp: sin número para unidad productiva', [
                'unidadproductiva_id' => $unidadProductiva->unidadproductiva_id,
            ]);
            return false;
        }

        $plantillaDatos = self::mapearDatosDesdeUnidadProductiva($unidadProductiva, $expectedFields);
        if ($plantillaDatos === null) {
            Log::warning('WhatsApp: faltan campos requeridos para plantilla', [
                'template_id' => $template->id,
                'unidadproductiva_id' => $unidadProductiva->unidadproductiva_id,
            ]);
            return false;
        }

        return self::enviar(
            $whatsappNumber,
            $template->name,
            $template->group_code,
            $plantillaDatos
        );
    }

    /**
     * Mapea expected_fields de la plantilla a valores desde UnidadProductiva / usuario / etapa.
     *
     * expected_fields (ejemplo en BD):
     * [
     *   {"key": "usuarioNOMBRE", "required": true},
     *   {"key": "empresaRAZONSOCIAL", "required": true},
     *   {"key": "etapaRUTAC", "required": true}
     * ]
     */
    public static function mapearDatosDesdeUnidadProductiva(UnidadProductiva $unidadProductiva, array $expectedFields): ?array
    {
        $unidadProductiva->loadMissing(['usuario', 'etapa']);

        $usuario = $unidadProductiva->usuario;
        $etapa = $unidadProductiva->etapa;

        $nombreUsuario = $usuario
            ? trim(($usuario->name ?? '') . ' ' . ($usuario->lastname ?? ''))
            : ($unidadProductiva->name_legal_representative ?? '');

        $map = [
            'usuarioNOMBRE' => $nombreUsuario,
            'empresaRAZONSOCIAL' => $unidadProductiva->business_name ?? '',
            'etapaRUTAC' => $etapa ? $etapa->name : '',
        ];

        $out = [];

        foreach ($expectedFields as $field) {
            // Puede venir como string o como array ['key' => '...', 'required' => true]
            if (is_string($field)) {
                $key = $field;
                $required = true;
            } else {
                $key = $field['key'] ?? '';
                $required = $field['required'] ?? true;
            }

            if ($key === '') {
                continue;
            }

            $value = $map[$key] ?? '';

            if ($required && (string) $value === '') {
                return null;
            }

            $out[$key] = (string) $value;
        }

        return $out;
    }

    /**
     * Obtiene el número WhatsApp del destinatario (unidad productiva).
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
        $digits = preg_replace('/\\D/', '', $numero);
        $code = '57';

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
     * Envía la plantilla a la API interna (sin bearer).
     * Content-Type: application/x-www-form-urlencoded
     *
     * Body (ejemplo):
     *  whatsappNumber=573041421586
     *  plantillaNombre=rutac_diagnostico_finalizado_1ro
     *  plantillaGrupo=DIAGNOSTICO_REALIZADO
     *  plantillaDatos[usuarioNOMBRE]=...
     *  plantillaDatos[empresaRAZONSOCIAL]=...
     *  plantillaDatos[etapaRUTAC]=...
     */
    public static function enviar(
        string $whatsappNumber,
        string $plantillaNombre,
        string $plantillaGrupo,
        array $plantillaDatos
    ): bool {
        $url = config('whatsapp_plantillas.api_url');
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

