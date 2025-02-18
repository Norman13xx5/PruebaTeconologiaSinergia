<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(class: [companies::class, modules::class, roles::class, permissions::class, users::class, salaries::class, typesids::class, genres::class, departments::class, municipalities::class, patients::class]);
    }
}
