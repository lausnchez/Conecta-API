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
        Schema::create('entidad_evento', function(Blueprint $table){
            $table->unsignedBigInteger('id_entidad');
            $table->unsignedBigInteger('id_evento');

            $table->string('tipo_relacion')->nullable(false);
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
        Schema::dropIfExists('entidad_evento');
    }
};
