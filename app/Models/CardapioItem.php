<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardapioItem extends Model
{
    use HasFactory;

    protected $table = 'cardapio_itens';

    protected $fillable = [
        'restaurante_id',
        'nome',
        'descricao',
        'preco_venda',
        'tempo_preparo_minutos',
        'complexidade_preparo',
        'categoria',
        'ativo_online',
    ];

    protected $casts = [
        'preco_venda' => 'decimal:2',
        'ativo_online' => 'boolean',
    ];

    public function restaurante()
    {
        return $this->belongsTo(Restaurante::class);
    }

    public function receitas()
    {
        return $this->hasMany(Receita::class);
    }

    public function pedidoItens()
    {
        return $this->hasMany(PedidoItem::class);
    }
}
