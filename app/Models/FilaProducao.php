<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FilaProducao extends Model
{
    use HasFactory;

    protected $table = 'fila_producao';

    protected $fillable = [
        'pedido_item_id',
        'pedido_id',
        'status_producao',
        'prioridade',
        'data_hora_inicio',
        'data_hora_fim',
    ];

    protected $casts = [
        'data_hora_inicio' => 'datetime',
        'data_hora_fim' => 'datetime',
    ];

    public function pedidoItem()
    {
        return $this->belongsTo(PedidoItem::class);
    }

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
}
