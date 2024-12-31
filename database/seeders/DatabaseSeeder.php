<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Users table with a single test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Call other seeders to populate data
        $this->call([
            EmployeesTableSeeder::class,
            ShiftsTableSeeder::class,
            LeavesTableSeeder::class,
            SpecialDutiesTableSeeder::class,
        ]);
    }
}
