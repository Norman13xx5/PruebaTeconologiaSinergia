<?php

namespace Database\Seeders;

use App\Models\Permiso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class permissions extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Permiso::create([
            'rolId' => 1, // ID del rol (por ejemplo, Administrador)
            'moduloId' => 1, // ID del módulo (debes tenerlo creado previamente)
            'r' => 1, // Permiso de lectura
            'w' => 1, // Permiso de escritura
            'u' => 1, // Permiso de actualización
            'd' => 1, // Permiso de eliminación
        ]);

        Permiso::create([
            'rolId' => 1, // ID del rol (por ejemplo, Administrador)
            'moduloId' => 2, // ID del módulo (debes tenerlo creado previamente)
            'r' => 1, // Permiso de lectura
            'w' => 1, // Permiso de escritura
            'u' => 1, // Permiso de actualización
            'd' => 1, // Permiso de eliminación
        ]);
    }
}
