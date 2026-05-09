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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();

            // Relación con el usuario que crea el ticket
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            // Datos del ticket
            $table->string('titulo');
            $table->text('descripcion');

            // Estado y Prioridad (con valores por defecto)
            $table->enum('estado', ['abierto', 'en_progreso', 'cerrado'])->default('abierto');
            $table->enum('prioridad', ['baja', 'media', 'alta'])->default('media');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
