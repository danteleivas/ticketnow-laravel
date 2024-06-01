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
        Schema::create('shows', function (Blueprint $table) {
            $table->id();
            $table->string('artista');
            $table->string('imagen')->nullable();
            $table->integer('disponibilidad_campo');
            $table->integer('disponibilidad_vip');
            $table->integer('disponibilidad_platea');
            $table->decimal('precio', 10, 2);

            $table->foreignId('place_id')->constrained();

            $table->date('fecha');
            $table->time('hora');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shows');
    }
};
