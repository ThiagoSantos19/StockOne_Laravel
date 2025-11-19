<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompraSugestao extends Model
{
    use HasFactory;

    protected $table = 'compras_sugestoes';

    protected $fillable = [
        'insumo_id',
        'quantidade_sugerida',
        'justificativa',
        'status',
        'periodo_analise_dias',
        'data_geracao',
    ];

    protected $casts = [
        'quantidade_sugerida' => 'decimal:3',
        'data_geracao' => 'date',
    ];

    public function insumo()
    {
        return $this->belongsTo(Insumo::class);
    }
}
