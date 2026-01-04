<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Roles;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Roles::updateOrCreate(['id' => 1], ['nombre' => 'Admin']);
        Roles::updateOrCreate(['id' => 2], ['nombre' => 'Developer']);
        Roles::updateOrCreate(['id' => 3], ['nombre' => 'General-User']);
    }
}
