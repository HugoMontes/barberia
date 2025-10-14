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
    Schema::create('barberos', function (Blueprint $table) {
        $table->id(); // PK personalizada
        $table->string('nombre');
        $table->string('apellido');
        $table->string('email')->unique(); // email único
        $table->string('especialidad');
        $table->timestamps(); // created_at y updated_at
        // la relacion es de 1 a 1 
        // $table->unsignedBigInteger('id_user')->unique();
        //     $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barberos');
    }
};
