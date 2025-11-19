<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alerta extends Model
{
    use HasFactory;

    protected $fillable = [
        'insumo_id',
        'tipo_alerta',
        'mensagem',
        'data_hora_alerta',
        'visualizado',
        'resolvido',
    ];

    protected $casts = [
        'data_hora_alerta' => 'datetime',
        'visualizado' => 'boolean',
        'resolvido' => 'boolean',
    ];

    public function insumo()
    {
        return $this->belongsTo(Insumo::class);
    }
}
