<?php

namespace Database\Seeders;

use App\Models\Rol;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class roles extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Rol::create([
            'nombreRol' => 'Administrador',
            'descripcion' => 'Rol con todos los permisos',
            'status' => 1,
        ]);

        Rol::create([
            'nombreRol' => 'Usuario',
            'descripcion' => 'Rol con permisos limitados',
            'status' => 1,
        ]);

        // Puedes agregar más roles aquí
    }
}
