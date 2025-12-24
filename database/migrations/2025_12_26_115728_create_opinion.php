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
        Schema::create('opiniones', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('id_entidad');
            $table->unsignedBigInteger('id_evento');
            
            $table->foreign('id_entidad')->references('id')->on('entidades')->cascadeOnDelete();
            $table->foreign('id_evento')->references('id')->on('eventos')->cascadeOnDelete();
            
            $table->text('contenido');
            $table->decimal('valoracion', 4, 2)->default(0);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opiniones');
    }
};
