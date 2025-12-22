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
        Schema::create('reporte', function (Blueprint $table) {
            $table->id('id_reporte');
            $table->unsignedBigInteger('id_entidad')->nullable(false);
            $table->unsignedBigInteger('id_evento')->nullable(false);

            $table->text('contenido')->nullable();
            //$table->date('fecha')->nullable(false);   Esto sustituirlo por los timestamps
            $table->timestamps();

            $table->foreign('id_entidad')->references('id_entidad')->on('entidad')->cascadeOnDelete();
            $table->foreign('id_evento')->references('id_evento')->on('evento')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reporte');
    }
};
