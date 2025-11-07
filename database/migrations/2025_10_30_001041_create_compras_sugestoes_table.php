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
        // Nome da tabela 'compras_sugestoes' conforme seu Model
        Schema::create('compras_sugestoes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('insumo_id')->constrained('insumos');
            
            $table->decimal('quantidade_sugerida', 10, 3);
            $table->text('justificativa')->nullable();
            $table->string('status', 50)->default('pendente');
            $table->integer('periodo_analise_dias')->nullable();
            $table->date('data_geracao');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras_sugestoes');
    }
};