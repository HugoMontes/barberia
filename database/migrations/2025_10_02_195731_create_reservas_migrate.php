<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_hora');
            $table->enum('estado', ['pendiente', 'confirmada', 'completada', 'cancelada'])->default('pendiente');
            $table->timestamps();

            // un clinete ase n reservas (1:N)
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');

            // un barbero atiende n reservas (1:N)
            $table->unsignedBigInteger('barbero_id');
            $table->foreign('barbero_id')->references('id')->on('barberos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('reservas');
    }
};
