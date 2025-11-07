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
        Schema::create('fila_producao', function (Blueprint $table) {
            $table->id();

            // O item de pedido que está na fila
            $table->foreignId('pedido_item_id')->constrained('pedido_itens')->onDelete('cascade');
            
            // O pedido ao qual o item pertence (para consulta fácil)
            $table->foreignId('pedido_id')->constrained('pedidos')->onDelete('cascade');

            $table->string('status_producao', 50)->default('pendente'); // Ex: pendente, preparando, pronto
            $table->integer('prioridade')->default(0);
            $table->dateTime('data_hora_inicio')->nullable();
            $table->dateTime('data_hora_fim')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fila_producao');
    }
};