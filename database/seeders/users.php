<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class users extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'nit' => 111111111,
            'identificacion' => '1111111111',
            'nombres' => 'admin',
            'aPaterno' => 'admin',
            'aMaterno' => 'admin',
            'telefono' => '1111111111',
            'emailUser' => 'admin@example.com',
            'pswd' => bcrypt('1234567890'),
            'nombreFiscal' => 'admin S.A.S.',
            'direccionFiscal' => 'Calle 45',
            'contentType' => 'application/json',
            'base64' => '',
            'rolId' => 1,
            'status' => 1,
        ]);

        User::create([
            'nit' => 222222222,
            'identificacion' => '1096251126',
            'nombres' => 'Brayan Guillermo',
            'aPaterno' => 'Diaz',
            'aMaterno' => 'Martinez',
            'telefono' => '3182834018',
            'emailUser' => 'brahyan.com@gmail.com',
            'pswd' => bcrypt('password123'),
            'nombreFiscal' => 'admin S.A.S.',
            'direccionFiscal' => 'Calle 45',
            'contentType' => 'application/json',
            'base64' => '',
            'rolId' => 1,
            'status' => 1,
        ]);
    }
}
