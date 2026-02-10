<?php

namespace Database\Seeders;

use App\Models\Categorias;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Ocio y Cultura (Cine, museos, teatro adaptado)
        Categorias::updateOrCreate(['id' => 1], [
            'nombre' => 'Cultura y Espectáculos',
            'descripcion' => 'Eventos culturales, cine, teatro y exposiciones con medidas de accesibilidad física y sensorial.'
        ]);

        // 2. Deporte y Salud (Importante para rehabilitación y mantenimiento)
        Categorias::updateOrCreate(['id' => 2], [
            'nombre' => 'Deporte y Salud',
            'descripcion' => 'Actividades de ejercicio físico adaptado, fisioterapia grupal y talleres de vida saludable.'
        ]);

        // 3. Formación (Brecha digital, talleres cognitivos)
        Categorias::updateOrCreate(['id' => 3], [
            'nombre' => 'Aprendizaje y Talleres',
            'descripcion' => 'Formación en nuevas tecnologías, manualidades y actividades de estimulación cognitiva.'
        ]);

        // 4. Social (Combate la soledad no deseada)
        Categorias::updateOrCreate(['id' => 4], [
            'nombre' => 'Social y Convivencia',
            'descripcion' => 'Puntos de encuentro, meriendas comunitarias y eventos para fomentar las redes de apoyo.'
        ]);

        // 5. Naturaleza (Rutas sin barreras)
        Categorias::updateOrCreate(['id' => 5], [
            'nombre' => 'Naturaleza y Aire Libre',
            'descripcion' => 'Salidas a parques, jardines y entornos naturales que cuentan con rutas e instalaciones accesibles.'
        ]);

        // 6. Trámites y Apoyo (Ayuda con la ley de dependencia, etc.)
        Categorias::updateOrCreate(['id' => 6], [
            'nombre' => 'Gestiones y Asesoría',
            'descripcion' => 'Charlas sobre derechos, ayuda con trámites administrativos y servicios de asistencia personal.'
        ]);

        // 7. Voluntariado (Participación activa)
        Categorias::updateOrCreate(['id' => 7], [
            'nombre' => 'Voluntariado y Participación',
            'descripcion' => 'Oportunidades para colaborar en la comunidad y participar activamente en proyectos sociales.'
        ]);
    }
}
