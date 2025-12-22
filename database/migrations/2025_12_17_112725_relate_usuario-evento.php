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
        Schema::create('usuario_evento', function(Blueprint $table){
            $table->unsignedBigInteger('id_usuario')->nullable(false);
            $table->unsignedBigInteger('id_evento')->nullable(false);

            $table->boolean('asistencia')->nullable(false)->default(false);
            $table->string('rol')->nullable();
            $table->timestamps();

            $table->foreign('id_usuario')->references('id_usuario')->on('users')->cascadeOnDelete();
            $table->foreign('id_evento')->references('id_evento')->on('eventos')->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropDatabaseIfExists('usuario_evento');
    }
};
