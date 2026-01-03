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
        Schema::create('logros_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_logro');
            $table->unsignedBigInteger('id_user');
            
            $table->integer('progreso')->default(0);

            $table->foreign('id_logro')->references('id')->on('logros')->cascadeOnDelete();
            $table->foreign('id_user')->references('id')->on('users')->cascadeOnDelete();

            $table->timestamps();
        });

        Schema::create('eventos_users', function (Blueprint $table) {
            $table->unsignedBigInteger('id_evento');
            $table->unsignedBigInteger('id_user');

            $table->primary(['id_evento', 'id_user']);
            
            $table->foreign('id_evento')->references('id')->on('eventos')->cascadeOnDelete();
            $table->foreign('id_user')->references('id')->on('users')->cascadeOnDelete();
            
        });

        Schema::create('eventos_tags', function (Blueprint $table) {
            $table->unsignedBigInteger('id_evento');
            $table->unsignedBigInteger('id_tag');

            $table->primary(['id_evento', 'id_tag']);
            
            $table->foreign('id_evento')->references('id')->on('eventos')->cascadeOnDelete();
            $table->foreign('id_tag')->references('id')->on('tags')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logros_users');
        Schema::dropIfExists('eventos_users');
        Schema::dropIfExists('eventos_tags');
    }
};
