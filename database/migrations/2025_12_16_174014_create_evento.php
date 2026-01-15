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
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
                       
            // Foreign Keys
            $table->unsignedBigInteger('id_categoria');
            $table->unsignedBigInteger('id_entidad');
            $table->unsignedBigInteger('id_creador');

            $table->foreign('id_creador')
                    ->references('id')
                    ->on('users')
                    ->cascadeOnDelete();

            $table->foreign('id_categoria')
                    ->references('id')
                    ->on('categorias')
                    ->cascadeOnDelete();

            $table->foreign('id_entidad')
                    ->references('id')
                    ->on('entidades')
                    ->cascadeOnDelete();

            // Campos propios
            $table->string('nombre');
            $table->date('fecha_evento');
            $table->text('descripcion')->nullable();
            $table->decimal('valoracion', 4, 2)->default(0);   // 0,00 de valoración

            // Ubicación -> Dato en MongoDB. Mongo usa ObjectId como id, por lo que usamos Strings
            $table->string('ubicacion', 24)->nullable();
            
            $table->integer('num_participantes')->default(0);
            $table->string('foto_evento')->nullable();
            $table->boolean('es_accesible')->default(false);

            // TimeStamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
