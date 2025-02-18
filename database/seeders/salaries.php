<?php

namespace Database\Seeders;

use App\Models\Salary;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class salaries extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Salary::create([
            'userId' => 1,
            'description' => 'Nomina',
            'amount' => 1000000,
            'status' => 1,
        ]);
        
        // Puedes agregar más empresas aquí
    }
}
