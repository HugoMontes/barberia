<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('reserva_servicios', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('servicio_id');
            $table->foreign('servicio_id')->references('id')
                ->on('servicios')->onDelete('cascade');

            $table->unsignedBigInteger('reserva_id');
            $table->foreign('reserva_id')->references('id')
                ->on('reservas')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('reserva_servicios');
    }
};
