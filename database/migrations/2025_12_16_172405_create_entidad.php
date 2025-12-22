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
        Schema::create('entidad', function(Blueprint $table){
            $table->id('id_entidad');
            $table->string('nombre')->nullable(false);
            $table->text('descripcion')->nullable();
            $table->boolean('es_accesible')->nullable(false)->default(false);
            $table->string('foto_entidad')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropDatabaseIfExists('entidad');
    }
};
