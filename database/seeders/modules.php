<?php

namespace Database\Seeders;

use App\Models\Modulo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class modules extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Modulo::create(attributes: [
            'menuId' => null, // Módulo principal
            'page' => null,
            'titulo' => 'Cuentas',
            'icono' => 'fas fa-tachometer-alt',
            'descripcion' => 'Página principal del sistema',
            'status' => 1,
        ]);

        Modulo::create(attributes: [
            'menuId' => 1, // Submódulo de Dashboard
            'page' => 'pacientes',
            'titulo' => 'Pacientes',
            'icono' => null,
            'descripcion' => 'Administración empresas',
            'status' => 1,
        ]);
    }
}
