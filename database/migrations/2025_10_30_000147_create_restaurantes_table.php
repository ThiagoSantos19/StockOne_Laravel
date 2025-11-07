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
        // Tabela 'restaurantes' (anteriormente 'restaurante')
        Schema::create('restaurantes', function (Blueprint $table) {
            // PK no padrão Eloquent (anteriormente id_restaurante)
            $table->id(); 

            $table->string('nome', 255);
            $table->string('cnpj', 18)->unique()->nullable();
            $table->text('endereco')->nullable();
            $table->string('telefone', 20)->nullable();
            $table->string('email', 255)->unique()->nullable();
            $table->string('status', 50)->default('ativo'); // Mantendo o status
            
            // Timestamps do Eloquent (substitui data_cadastro)
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurantes');
    }
};