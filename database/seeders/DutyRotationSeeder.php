<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DutyRotationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('duty_rotations')->insert([
            [
                'type' => 'Late Night',
                'employee_id' => 6, // Example employee_id
                'start_date' => '2024-12-01',
                'sequence_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Late Night',
                'employee_id' => 8,
                'start_date' => '2024-12-11',
                'sequence_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
                        [
                'type' => 'Late Night',
                'employee_id' => 9,
                'start_date' => '2024-12-21',
                'sequence_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'type' => 'Picture Selection',
                'employee_id' => 7,
                'start_date' => '2024-12-01',
                'sequence_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
                        [
                'type' => 'Picture Selection',
                'employee_id' => 6,
                'start_date' => '2024-12-11',
                'sequence_order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
                                    [
                'type' => 'Picture Selection',
                'employee_id' => 9,
                'start_date' => '2024-12-21',
                'sequence_order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more rows as needed
        ]);
    }
}
