<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Departments extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Department::create([
            'nombre' => 'Santander',
        ]);

        Department::create([
            'nombre' => 'Antioquia',
        ]);

        Department::create([
            'nombre' => 'Cundinamarca',
        ]);

        Department::create([
            'nombre' => 'Valle del Cauca',
        ]);

        Department::create([
            'nombre' => 'Atlántico',
        ]);
    }
}
