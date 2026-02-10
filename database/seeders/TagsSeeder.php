<?php

namespace Database\Seeders;

use App\Models\Tags;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Temáticas de interés
        Tags::updateOrCreate(['id' => 1], ['nombre' => 'Música']);
        Tags::updateOrCreate(['id' => 2], ['nombre' => 'Tecnología']);
        Tags::updateOrCreate(['id' => 3], ['nombre' => 'Gastronomía']);
        Tags::updateOrCreate(['id' => 4], ['nombre' => 'Arte']);
        Tags::updateOrCreate(['id' => 5], ['nombre' => 'Cine']);
        Tags::updateOrCreate(['id' => 6], ['nombre' => 'Literatura']);
        Tags::updateOrCreate(['id' => 7], ['nombre' => 'Historia']);
        Tags::updateOrCreate(['id' => 8], ['nombre' => 'Ciencia']);

        // Tipos de actividad
        Tags::updateOrCreate(['id' => 9], ['nombre' => 'Taller']);
        Tags::updateOrCreate(['id' => 10], ['nombre' => 'Conferencia']);
        Tags::updateOrCreate(['id' => 11], ['nombre' => 'Concierto']);
        Tags::updateOrCreate(['id' => 12], ['nombre' => 'Exposición']);
        Tags::updateOrCreate(['id' => 13], ['nombre' => ' networking']);
        Tags::updateOrCreate(['id' => 14], ['nombre' => 'Competición']);
        Tags::updateOrCreate(['id' => 15], ['nombre' => 'Feria']);

        // Público y Ambiente
        Tags::updateOrCreate(['id' => 16], ['nombre' => 'Familiar']);
        Tags::updateOrCreate(['id' => 17], ['nombre' => 'Infantil']);
        Tags::updateOrCreate(['id' => 18], ['nombre' => 'Juvenil']);
        Tags::updateOrCreate(['id' => 19], ['nombre' => 'Para profesionales']);
        Tags::updateOrCreate(['id' => 20], ['nombre' => 'Al aire libre']);
        Tags::updateOrCreate(['id' => 21], ['nombre' => 'Nocturno']);

        // Logística y Coste
        Tags::updateOrCreate(['id' => 22], ['nombre' => 'Gratis']);
        Tags::updateOrCreate(['id' => 23], ['nombre' => 'De pago']);
        Tags::updateOrCreate(['id' => 24], ['nombre' => 'Online']);
        Tags::updateOrCreate(['id' => 25], ['nombre' => 'Presencial']);
        Tags::updateOrCreate(['id' => 26], ['nombre' => 'Híbrido']);
        Tags::updateOrCreate(['id' => 27], ['nombre' => 'Requiere inscripción']);

        // Estilo de vida
        Tags::updateOrCreate(['id' => 28], ['nombre' => 'Sostenible']);
        Tags::updateOrCreate(['id' => 29], ['nombre' => 'Saludable']);
        Tags::updateOrCreate(['id' => 30], ['nombre' => 'Viajes']);
        Tags::updateOrCreate(['id' => 31], ['nombre' => 'Moda']);
        Tags::updateOrCreate(['id' => 32], ['nombre' => 'Videojuegos']);
        Tags::updateOrCreate(['id' => 33], ['nombre' => 'Mascotas']);
    }
}
