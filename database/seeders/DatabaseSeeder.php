<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin 1',
            'email' => 'admin1@gmail.com',
            'password' => bcrypt('password'),
            'roles' => 'admin'
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Admin 2',
            'email' => 'admin2@gmail.com',
            'password' => bcrypt('password'),
            'roles' => 'admin'
            // $2y$10$eyVNtiqzOTnPcyB826gLZ.3EHKzCvquSLVpHUcgYYBzP7V4dFhZpC
        ]);
    }
}
