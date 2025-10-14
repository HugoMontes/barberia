<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('detalle_factura', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad')->default(1);
            $table->float('precio_unitario'); // Precio del servicio
            $table->float('subtotal'); // cantidad × precio_unitario
            $table->timestamps();

            $table->unsignedBigInteger('factura_id');
            $table->foreign('factura_id')->references('id')->on('facturas')->onDelete('cascade');

            $table->unsignedBigInteger('servicio_id');
            $table->foreign('servicio_id')->references('id')->on('servicios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('detalle_factura');
    }
};
