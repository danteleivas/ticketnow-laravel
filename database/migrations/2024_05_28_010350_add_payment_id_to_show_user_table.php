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
            $table->string('payment_id')->nullable()->after('codigo_qr'); 

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('show_user', function (Blueprint $table) {
            $table->dropColumn('payment_id'); 

        });
    }
};
