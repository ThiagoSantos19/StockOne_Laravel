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
        // Tabela 'insumos' (anteriormente 'insumo')
        Schema::create('insumos', function (Blueprint $table) {
            $table->id(); 
            
            // FK para o Restaurante (essencial para o multi-tenant)
            $table->foreignId('restaurante_id')->constrained('restaurantes'); 

            $table->string('nome', 255);
            $table->string('descricao', 255)->nullable();
            $table->string('categoria', 100)->nullable();
            $table->string('unidade_medida', 50);
            $table->decimal('ponto_reposicao_minimo', 10, 2)->default(0);
            $table->decimal('custo_unitario', 10, 2)->nullable();
            $table->date('data_validade_minima')->nullable();
            
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('insumos');
    }
};