<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PedidoItem extends Model
{
    use HasFactory;

    protected $table = 'pedido_itens';

    protected $fillable = [
        'pedido_id',
        'cardapio_item_id',
        'quantidade',
        'preco_unitario',
        'observacao',
    ];

    protected $casts = [
        'preco_unitario' => 'decimal:2',
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }

    public function cardapioItem()
    {
        return $this->belongsTo(CardapioItem::class);
    }

    public function filaProducao()
    {
        return $this->hasOne(FilaProducao::class);
    }
}
