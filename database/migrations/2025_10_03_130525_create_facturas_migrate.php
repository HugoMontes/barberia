<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('facturas', function (Blueprint $table) {
            $table->id();
            $table->text('nombre_comprador', 50);
            $table->text('nit_comprador', 20);
            $table->date('fecha_emision');
            $table->float('total');
            $table->enum('estado', ['pendiente', 'pagada', 'cancelada']);

            // 1 a N
            // $table->unsignedBigInteger('id_cliente');
            // $table->foreign('id_cliente')->references('id')->on('clientes')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('facturas');
    }
};
