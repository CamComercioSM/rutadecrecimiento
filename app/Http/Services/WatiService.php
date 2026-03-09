<?php

namespace App\Http\Services;

use App\Models\UnidadProductiva;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WatiService
{
    /**
     * Envía la plantilla de diagnóstico finalizado por WATI al completar un diagnóstico.
     * Equivalente a la plantilla rutac_diagnostico_finalizado_1ro (usuario, empresa, etapa).
     */
    public static function enviarDiagnosticoFinalizado(UnidadProductiva $unidadProductiva): bool
    {
        $whatsappNumber = self::obtenerNumeroWhatsApp($unidadProductiva);
        if (!$whatsappNumber) {
            Log::warning('WATI: sin número para unidad productiva', [
                'unidadproductiva_id' => $unidadProductiva->unidadproductiva_id,
            ]);
            return false;
        }

        $unidadProductiva->loadMissing(['usuario', 'etapa']);
        $usuario = $unidadProductiva->usuario;
        $etapa = $unidadProductiva->etapa;

        $nombreUsuario = $usuario
            ? trim(($usuario->name ?? '') . ' ' . ($usuario->lastname ?? ''))
            : ($unidadProductiva->name_legal_representative ?? '');
        $empresaRazonSocial = $unidadProductiva->business_name ?? '';
        $etapaRutac = $etapa ? $etapa->name : '';

        $config = config('wati.plantilla_diagnostico_finalizado', []);
        $templateName = $config['template_name'] ?? 'rutac_diagnostico_finalizado_1ro';
        $broadcastName = $config['broadcast_name'] ?? 'diagnostico_finalizado';

        // WATI suele usar parámetros "1", "2", "3" para las variables de la plantilla
        $parameters = [
            ['name' => '1', 'value' => (string) $nombreUsuario],
            ['name' => '2', 'value' => (string) $empresaRazonSocial],
            ['name' => '3', 'value' => (string) $etapaRutac],
        ];

        return self::enviarPlantilla(
            $whatsappNumber,
            $templateName,
            $broadcastName,
            $parameters
        );
    }

    /**
     * Obtiene el número WhatsApp del destinatario (unidad productiva).
     * Prioridad: mobile, telephone, contact_phone. Normalizado con código país.
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

        return self::normalizarNumero((string) $raw);
    }

    /**
     * Normaliza número a solo dígitos con código país (por defecto 57).
     */
    public static function normalizarNumero(string $numero): string
    {
        $digits = preg_replace('/\D/', '', $numero);
        $code = config('wati.default_country_code', '57');

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
     * Envía una plantilla por la API WATI v2.
     *
     * @param string $whatsappNumber Número con código país (ej: 573001234567)
     * @param string $templateName Nombre de la plantilla en WATI
     * @param string $broadcastName Nombre del broadcast
     * @param array $parameters [ ['name' => '1', 'value' => '...'], ... ]
     */
    public static function enviarPlantilla(
        string $whatsappNumber,
        string $templateName,
        string $broadcastName,
        array $parameters
    ): bool {
        $endpoint = config('wati.api_endpoint');
        $token = config('wati.api_token');
        $channelNumber = config('wati.channel_number');

        if (!$endpoint || !$token || !$channelNumber) {
            Log::error('WATI: faltan WATI_API_ENDPOINT, WATI_API_TOKEN o WATI_CHANNEL_NUMBER en .env');
            return false;
        }

        $url = $endpoint . '/api/v2/sendTemplateMessage?whatsappNumber=' . $whatsappNumber;

        $body = [
            'template_name' => $templateName,
            'broadcast_name' => $broadcastName,
            'channel_number' => $channelNumber,
            'parameters' => $parameters,
        ];

        try {
            $response = Http::withToken($token)
                ->acceptJson()
                ->timeout(15)
                ->withOptions(['proxy' => false])
                ->post($url, $body);

            if ($response->successful()) {
                $data = $response->json();
                if ($data['result'] ?? false) {
                    Log::info('WATI plantilla enviada', [
                        'template' => $templateName,
                        'to' => $whatsappNumber,
                    ]);
                    return true;
                }
            }

            Log::error('WATI API error', [
                'status' => $response->status(),
                'body' => $response->body(),
                'template' => $templateName,
                'to' => $whatsappNumber,
            ]);
            return false;
        } catch (\Throwable $e) {
            Log::error('WATI excepción', [
                'error' => $e->getMessage(),
                'template' => $templateName,
                'to' => $whatsappNumber,
            ]);
            return false;
        }
    }
}
