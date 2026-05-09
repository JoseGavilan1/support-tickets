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
        Schema::table('mensajes', function (Blueprint $table) {
            // Agregamos la columna, y le decimos que puede ser nula (no todos los mensajes tendrán imagen)
            $table->string('archivo_path')->nullable()->after('contenido');
        });
    }

    public function down(): void
    {
        Schema::table('mensajes', function (Blueprint $table) {
            $table->dropColumn('archivo_path');
        });
    }
};
