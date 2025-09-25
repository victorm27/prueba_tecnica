<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreasRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Area::insert([
            ['nombre' => 'Administración'],
            ['nombre' => 'Recursos Humanos'],
            ['nombre' => 'Desarrollo'],
            ['nombre' => 'Ventas'],
        ]);

        \App\Models\Rol::insert([
            ['nombre' => 'Gerente'],
            ['nombre' => 'Analista'],
            ['nombre' => 'Desarrollador'],
            ['nombre' => 'Soporte'],
        ]);
    }
}
