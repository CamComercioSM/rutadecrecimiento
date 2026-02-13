<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhatsappTemplate extends Model
{
    protected $table = 'whatsapp_templates';

    protected $fillable = [
        'category_id',
        'name',
        'group_code',
        'channel',
        'expected_fields',
    ];

    protected $casts = [
        'expected_fields' => 'array',
    ];

    /**
     * Convierte el modelo a array compatible con WhatsAppPlantillaService.
     *
     * @return array{name: string, group_code: string, expected_fields: array}
     */
    public function toPlantillaConfig(): array
    {
        return [
            'name' => $this->name,
            'group_code' => $this->group_code ?? '',
            'expected_fields' => $this->expected_fields ?? [],
        ];
    }
}
