<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    // FALTA UNIR CON LA BASE DE DATOS DE MONGODB

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Falta conectividad con MongoDB para la relación con las geolocalizaciones

        Schema::create('entidades', function(Blueprint $table){
            $table->id();

            $table->string('nombre');
            $table->text('descripcion')->nullable();
            $table->boolean('es_accesible')->default(false);
            $table->string('foto_entidad')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entidades');
    }
};
