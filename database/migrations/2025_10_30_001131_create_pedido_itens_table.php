<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tabela 'pedido_itens' (anteriormente item_pedido/itempedido)
        Schema::create('pedido_itens', function (Blueprint $table) {
            $table->id(); 
            
            // FKs no padrão Eloquent
            $table->foreignId('pedido_id')->constrained('pedidos')->onDelete('cascade'); 
            $table->foreignId('cardapio_item_id')->constrained('cardapio_itens'); 

            $table->integer('quantidade');
            $table->decimal('preco_unitario', 10, 2);
            $table->text('observacao')->nullable();

            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedido_itens');
    }
};