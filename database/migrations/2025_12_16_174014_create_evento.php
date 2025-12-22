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
        Schema::create('evento', function (Blueprint $table) {
            $table->id('id_evento');
                       
            // Foreign Keys
            $table->unsignedBigInteger('id_categoria')->nullable(false);
            $table->unsignedBigInteger('id_user')->nullable(false);
            $table->unsignedBigInteger('id_entidad')->nullable(false);

            $table->foreign('id_user')
                    ->references('id')
                    ->on('users')
                    ->nullOnDelete();

            $table->foreign('id_categoria')
                    ->references('id_categoria')
                    ->on('categoria')
                    ->nullOnDelete();

            $table->foreign('id_entidad')
                    ->references('id_entidad')
                    ->on('entidad')
                    ->nullOnDelete();

            // Campos propios
            $table->string('nombre')->nullable(false);
            $table->date('fecha_evento')->nullable(false);
            $table->text('descripcion')->nullable(false);
            $table->decimal('valoracion', 3, 2)->nullable(false)->default(0);   // 0,00 de valoración

            // Ubicación ->Dato en MongoDB. Mongo usa ObjectId como id, por lo que usamos Strings
            $table->integer('ubicacion')->nullable();   // La ponemos false?
            
            $table->integer('num_participantes')->nullable(false)->default(0);
            $table->integer('max_participantes')->nullable();   // Para que en caso de que haya un tope de participantes se pueda mirar
            $table->string('foto_evento')->nullable();
            $table->boolean('es_accesible')->nullable(false)->default(false);

            // TimeStamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evento');
    }
};
