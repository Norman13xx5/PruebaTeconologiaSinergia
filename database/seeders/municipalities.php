<?php

namespace Database\Seeders;

use App\Models\Municipality;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Municipalities extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Municipality::create([
            'departamento_id' => 1,
            'nombre' => 'Barrancabermeja',
        ]);
        Municipality::create([
            'departamento_id' => 1,
            'nombre' => 'Piedecuesta',
        ]);

        Municipality::create([
            'departamento_id' => 1,
            'nombre' => 'Medellín',
        ]);
        Municipality::create([
            'departamento_id' => 1,
            'nombre' => 'Envigado',
        ]);

        Municipality::create([
            'departamento_id' => 1,
            'nombre' => 'Bogotá',
        ]);
        Municipality::create([
            'departamento_id' => 1,
            'nombre' => 'Soacha',
        ]);

        Municipality::create([
            'departamento_id' => 1,
            'nombre' => 'Cali',
        ]);
        Municipality::create([
            'departamento_id' => 1,
            'nombre' => 'Palmira',
        ]);

        Municipality::create([
            'departamento_id' => 1,
            'nombre' => 'Barranquilla',
        ]);
        Municipality::create([
            'departamento_id' => 1,
            'nombre' => 'Soledad',
        ]);
    }
}
