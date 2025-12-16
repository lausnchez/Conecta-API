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
            $table->unsignedBigInteger('id_categoria')->nullable();

            $table->id('id_evento');
            $table->date('fecha_evento')->nullable(false);
            $table->string('tipo_evento', 100)->nullable();
            $table->boolean('bool_acceso')->default(false);
            $table->boolean('bool_acceso')->default(false);
            $table->boolean('bool_equipo')->default(false);
            $table->boolean('bool_masc')->default(false);
            $table->text('descripcion')->nullable();
            $table->integer('num_participantes')->nullable();
            $table->text('incidencias')->nullable();
            $table->float('valoracion')->nullable();

            $table->timestamps();

            $table->foreign('id_categoria')
                    ->references('id_categoria')
                    ->on('categoria')
                    ->nullOnDelete();
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
