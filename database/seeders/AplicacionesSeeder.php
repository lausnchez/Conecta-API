<?php

namespace Database\Seeders;

use App\Models\Aplicaciones;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AplicacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Aplicaciones::updateOrCreate(['id' => 1], ['nombre_app' => 'Deportes']);
        Aplicaciones::updateOrCreate(['id' => 2], ['nombre_app' => 'Mayores']);
        Aplicaciones::updateOrCreate(['id' => 3], ['nombre_app' => 'Jóvenes']);
    }
}
