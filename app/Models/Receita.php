<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receita extends Model
{
    use HasFactory;

    protected $fillable = [
        'cardapio_item_id',
        'insumo_id',
        'quantidade_necessaria',
        'essencial',
    ];

    protected $casts = [
        'quantidade_necessaria' => 'decimal:2',
        'essencial' => 'boolean',
    ];

    public function cardapioItem()
    {
        return $this->belongsTo(CardapioItem::class);
    }

    public function insumo()
    {
        return $this->belongsTo(Insumo::class);
    }
}
