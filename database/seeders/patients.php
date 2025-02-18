<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class patients extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Patient::create([
            'tipo_documento_id' => 1,
            'numero_documento' => '1096251126',
            'nombre1' => 'Brayan',
            'nombre2' => 'Guillermo',
            'apellido1' => 'Diaz',
            'apellido2' => 'Martinez',
            'genero_id' => 1,
            'departamento_id' => 1,
            'municipio_id' => 1
        ]);
        Patient::create([
            'tipo_documento_id' => 1,
            'numero_documento' => '1234567890',
            'nombre1' => 'Carlos',
            'nombre2' => 'Andrés',
            'apellido1' => 'Gonzalez',
            'apellido2' => 'Pérez',
            'genero_id' => 2,
            'departamento_id' => 1,
            'municipio_id' => 2
        ]);

        Patient::create([
            'tipo_documento_id' => 2,
            'numero_documento' => '9876543210',
            'nombre1' => 'Laura',
            'nombre2' => 'Isabel',
            'apellido1' => 'Martinez',
            'apellido2' => 'Lopez',
            'genero_id' => 1,
            'departamento_id' => 2,
            'municipio_id' => 1
        ]);

        Patient::create([
            'tipo_documento_id' => 1,
            'numero_documento' => '1122334455',
            'nombre1' => 'Sofia',
            'nombre2' => 'Valentina',
            'apellido1' => 'Hernandez',
            'apellido2' => 'García',
            'genero_id' => 2,
            'departamento_id' => 1,
            'municipio_id' => 2
        ]);

        Patient::create([
            'tipo_documento_id' => 2,
            'numero_documento' => '5566778899',
            'nombre1' => 'Javier',
            'nombre2' => 'Alberto',
            'apellido1' => 'Ramirez',
            'apellido2' => 'Sanchez',
            'genero_id' => 1,
            'departamento_id' => 2,
            'municipio_id' => 1
        ]);
    }
}
