<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class PlatformStatusService
{
    protected const URL = 'https://servicos.saude.mt.gov.br/telessaude/';
    protected const CACHE_KEY = 'telessaude_platform_online_status';
    protected const CACHE_TTL_SECONDS = 90; // Checa no máximo a cada 1 minuto e meio

    /**
     * Retorna se a plataforma externa está online (HTTP 200, 301, 302, etc.)
     */
    public static function isOnline(): bool
    {
        return Cache::remember(self::CACHE_KEY, self::CACHE_TTL_SECONDS, function () {
            try {
                // Requisição rápida HEAD / GET com timeout estrito de 2.5s
                $response = Http::withoutVerifying()
                    ->timeout(2.5)
                    ->connectTimeout(2.0)
                    ->get(self::URL);

                // Se responder qualquer status da faixa 200-399, está acessível/no ar
                return $response->successful() || $response->redirect();
            } catch (\Throwable $e) {
                return false;
            }
        });
    }

    /**
     * Retorna detalhes de status para exibição
     */
    public static function getStatusData(): array
    {
        $online = self::isOnline();

        return [
            'is_online' => $online,
            'label' => $online ? 'Acesso ao Sistema' : 'Sistema em Manutenção',
            'tooltip' => $online 
                ? 'Plataforma Estadual de Telessaúde: Operando normalmente' 
                : 'Plataforma em implantação/manutenção técnica programada',
            'url' => self::URL,
        ];
    }
}
