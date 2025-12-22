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
        Schema::table('users', function (Blueprint $table) {
            //$table->id('id_usuario');
            //$table->string('tipo', 50)->nullable(false);  <- no se qué hace
            $table->string('nombre', 100)->nullable(false);
            $table->string('apellido', 100)->nullable(false);
            //$table->string('email', 255)->unique()->nullable(false);
            $table->string('telefono', 20)->nullable();
            $table->boolean('es_empresa')->default(false);
            $table->boolean('es_familiar')->default(false);
            $table->date('fecha_nacimiento')->nullable();
            $table->decimal('procentaje_discapacidad', 5, 2)->default(0.00);
            $table->unsignedBigInteger('rol')->nullable(false)->default(0);
            //$table->string('password_hash')->nullable(false);
            //$table->timestamps();   // Incluye created_at y Updated_at

            // Borrados de la tabla original
            $table->dropColumn('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Borrar campos creados manualmente
            $table->dropColumn('nombre');
            $table->dropColumn('apellido');
            $table->dropColumn('telefono');
            $table->dropColumn('es_empresa');
            $table->dropColumn('es_familiar');
            $table->dropColumn('fecha_nacimiento');
            $table->dropColumn('porcentaje_discapacidad');

            // Restaurar campos generados originalmente
            $table->string('name');
        });
    }
};
