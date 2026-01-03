<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Llamar a los seeders con las fk
        $this->call([
            RolesSeeder::class,
        ]);

        // Crear usuarios
        User::factory()->create([
            'nombre' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
