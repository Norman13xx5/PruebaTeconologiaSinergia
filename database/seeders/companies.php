<?php

namespace Database\Seeders;

use App\Models\Empresa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class companies extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Empresa::create([
            'nit' => 111111111,
            'digito' => 0,
            'nombre' => 'Empresa Ejemplo 1 S.A.S.',
            'representante' => 'Empresa 1',
            'telefono' => '987654321',
            'direccion' => 'Calle 456',
            'correo' => 'contacto@empresa.com',
            'pais' => 'Colombia',
            'ciudad' => 'Bogotá',
            'contacto' => 'Empresa 1',
            'emailTec' => 'tecnico@empresa.com',
            'emailLogis' => 'logistica@empresa.com',
            'contentType' => 'application/json',
            'base64' => '',
            'fechaInicio' => now(),
            'fechaCorte' => now(),
            'status' => 1,
        ]);

        Empresa::create([
            'nit' => 222222222,
            'digito' => 0,
            'nombre' => 'Empresa Ejemplo 2 S.A.S.',
            'representante' => 'Empresa 2',
            'telefono' => '987654321',
            'direccion' => 'Calle 456',
            'correo' => 'contacto@empresa.com',
            'pais' => 'Colombia',
            'ciudad' => 'Bogotá',
            'contacto' => 'Empresa 2',
            'emailTec' => 'tecnico@empresa.com',
            'emailLogis' => 'logistica@empresa.com',
            'contentType' => 'application/json',
            'base64' => '',
            'fechaInicio' => now(),
            'fechaCorte' => now(),
            'status' => 1,
        ]);

        // Puedes agregar más empresas aquí
    }
}
