<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::table('facturas', function (Blueprint $table) {
            $table->text('descripcion')->nullable();
            $table->foreignId('reserva_id')->nullable()->constrained('reservas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('facturas', function (Blueprint $table) {
            $table->dropForeign(['reserva_id']);
            $table->dropColumn('reserva_id');
            $table->dropColumn('descripcion');
        });
    }
};
