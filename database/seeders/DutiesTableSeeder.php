<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DutiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Use Carbon for date manipulation
        $today = Carbon::today();

        // Sample duty assignments
        $duties = [
            [
                'type' => 'Late Night',
                'employee_id' => 6, // Asheque
                'start_date' => $today->toDateString(),
                'end_date' => $today->copy()->addDays(9)->toDateString(),
            ],
            [
                'type' => 'Picture Selection',
                'employee_id' => 7, // Protap
                'start_date' => $today->copy()->addDays(10)->toDateString(),
                'end_date' => $today->copy()->addDays(19)->toDateString(),
            ],
            [
                'type' => 'Bideshi News Duty',
                'employee_id' => 12, // Shefarul
                'start_date' => $today->toDateString(),
                'end_date' => null, // Continuous duty
            ],
            [
                'type' => 'Late Night',
                'employee_id' => 8, // Nadim
                'start_date' => $today->copy()->addDays(20)->toDateString(),
                'end_date' => $today->copy()->addDays(29)->toDateString(),
            ],
        ];

        // Insert into database
        foreach ($duties as $duty) {
            DB::table('duties')->insert([
                'type' => $duty['type'],
                'employee_id' => $duty['employee_id'],
                'start_date' => $duty['start_date'],
                'end_date' => $duty['end_date'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
