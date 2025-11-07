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
        // Tabela 'receitas' (anteriormente 'receita') - Tabela Pivô
        Schema::create('receitas', function (Blueprint $table) {
            $table->id(); 
            
            // FKs no padrão Eloquent
            $table->foreignId('cardapio_item_id')->constrained('cardapio_itens')->onDelete('cascade'); 
            $table->foreignId('insumo_id')->constrained('insumos')->onDelete('cascade'); 

            $table->decimal('quantidade_necessaria', 10, 2);
            
            // CAMPO CRÍTICO PARA RN-001: Indica se o insumo é essencial para a produção.
            $table->boolean('essencial')->default(true); 

            // Chave única para evitar receitas duplicadas
            $table->unique(['cardapio_item_id', 'insumo_id']);

            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receitas');
    }
};