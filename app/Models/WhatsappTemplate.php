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
        'is_active',
    ];

    protected $casts = [
        'expected_fields' => 'array',
        'is_active' => 'boolean',
    ];
}

