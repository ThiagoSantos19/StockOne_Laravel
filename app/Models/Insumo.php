<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Insumo extends Model
{
    use HasFactory;

    protected $fillable = [
        'restaurante_id',
        'nome',
        'descricao',
        'categoria',
        'unidade_medida',
        'ponto_reposicao_minimo',
        'custo_unitario',
        'data_validade_minima',
    ];

    protected $casts = [
        'data_validade_minima' => 'date',
        'ponto_reposicao_minimo' => 'decimal:2',
        'custo_unitario' => 'decimal:2',
    ];

    public function restaurante()
    {
        return $this->belongsTo(Restaurante::class);
    }

    public function estoque()
    {
        return $this->hasOne(Estoque::class);
    }

    public function alertas()
    {
        return $this->hasMany(Alerta::class);
    }

    public function comprasSugestoes()
    {
        return $this->hasMany(CompraSugestao::class);
    }

    public function receitas()
    {
        return $this->hasMany(Receita::class);
    }
}
