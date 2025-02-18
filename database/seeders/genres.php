<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class genres extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Genre::create([
            'nombre' => 'Masculino',
        ]);

        Genre::create([
            'nombre' => 'Femenino',
        ]);
    }
}
