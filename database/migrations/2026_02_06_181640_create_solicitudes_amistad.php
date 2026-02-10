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
        Schema::create('solicitudes_amistad', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_usuario_sender');
            $table->unsignedBigInteger('id_usuario_receptor');

            $table->foreign('id_usuario_sender')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
            $table->foreign('id_usuario_receptor')
                ->references('id')
                ->on('users')
                ->cascadeOnDelete();
                
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitudes_amistad');
    }
};
