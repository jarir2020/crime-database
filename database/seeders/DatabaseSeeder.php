<?php

namespace Database\Seeders;

use App\Models\User;
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

        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('123456'),
                'is_admin' => true,
            ]
        );

        User::updateOrCreate(
            ['email' => 'jarircse16@gmail.com'],
            [
                'name' => 'Jarir User',
                'password' => bcrypt('123456'),
                'is_admin' => false,
            ]
        );
    }
}
