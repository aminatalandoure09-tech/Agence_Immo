<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Appel de votre seeder d'administrateur
        $this->call([
            AdminSeeder::class,
        ]);
    }
}