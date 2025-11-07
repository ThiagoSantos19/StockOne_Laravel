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
        // Tabela 'cardapio_itens' (anteriormente item_cardapio/itemcardapio)
        Schema::create('cardapio_itens', function (Blueprint $table) {
            $table->id(); 
            
            // FK no padrão Eloquent (restaurante_id)
            $table->foreignId('restaurante_id')->constrained('restaurantes'); 

            $table->string('nome', 255);
            $table->text('descricao')->nullable();
            $table->decimal('preco_venda', 10, 2);
            $table->integer('tempo_preparo_minutos')->nullable();
            $table->integer('complexidade_preparo')->default(1);
            $table->string('categoria', 100)->nullable();
            
            // Campo crucial para a RN-001 (Sincronização de Cardápio)
            $table->boolean('ativo_online')->default(true); 

            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cardapio_itens');
    }
};