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
        Schema::create('alertas', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('insumo_id')->constrained('insumos')->onDelete('cascade');
            
            $table->string('tipo_alerta', 100); // Ex: 'EstoqueBaixo', 'ValidadeProxima'
            $table->text('mensagem');
            $table->dateTime('data_hora_alerta')->useCurrent();
            $table->boolean('visualizado')->default(false);
            $table->boolean('resolvido')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alertas');
    }
};