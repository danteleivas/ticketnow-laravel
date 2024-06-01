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
        Schema::table('show_user', function (Blueprint $table) {
            // Agregar el campo 'procesado'
            $table->boolean('procesado')->default('0')->after('codigo_qr');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('show_user', function (Blueprint $table) {
            // Eliminar el campo 'procesado'
            $table->dropColumn('procesado');
        });
    }
};
