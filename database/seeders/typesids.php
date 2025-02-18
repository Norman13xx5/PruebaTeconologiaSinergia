<?php

namespace Database\Seeders;

use App\Models\Typesid;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class typesids extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Typesid::create([
            'nombre' => 'Cedula de Ciudadania',
        ]);

        Typesid::create([
            'nombre' => 'Pasaporte',
        ]);
    }
}
