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
        // Tabela 'estoque' (Baseada no diagrama)
        Schema::create('estoque', function (Blueprint $table) {
            $table->id();

            // Relação 1:1 com Insumo. Cada insumo tem uma entrada de estoque.
            $table->foreignId('insumo_id')->constrained('insumos')->onDelete('cascade')->unique();

            $table->decimal('quantidade_atual', 10, 3); // Mais precisão para 'kg'
            $table->string('localizacao', 255)->nullable();
            
            // data_ultima_atualizacao é coberta por 'updated_at'
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('estoque');
    }
};