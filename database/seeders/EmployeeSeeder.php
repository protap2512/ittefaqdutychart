<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employees')->insert([
            [
                'name' => 'Sazzad',
                'designation' => 'News Editor',
                'weekly_offday' => 'Saturday',
                'profile_image' => 'images/employees/sazzad.jpg',
            ],
            [
                'name' => 'Ashok',
                'designation' => 'News Editor',
                'weekly_offday' => 'Sunday',
                'profile_image' => 'images/employees/ashok.jpg',
            ],
            [
                'name' => 'Mamun',
                'designation' => 'Shift Incharge',
                'weekly_offday' => 'Friday',
                'profile_image' => 'images/employees/mamun.jpg',
            ],
            [
                'name' => 'Sukomal',
                'designation' => 'Shift Incharge',
                'weekly_offday' => 'Saturday',
                'profile_image' => 'images/employees/sukomal.jpg',
            ],
                        [
                'name' => 'Jakir',
                'designation' => 'Shift Incharge',
                'weekly_offday' => 'Saturday',
                'profile_image' => 'images/employees/jakir.jpg',
            ],
            [
                'name' => 'Asheque',
                'designation' => 'Sub Editor',
                'weekly_offday' => 'Monday',
                'profile_image' => 'images/employees/asheque.jpg',
            ],
                        [
                'name' => 'Protap',
                'designation' => 'Sub Editor',
                'weekly_offday' => 'Wednesday',
                'profile_image' => 'images/employees/protap.jpg',
            ],
                        [
                'name' => 'Nadim',
                'designation' => 'Sub Editor',
                'weekly_offday' => 'Saturday',
                'profile_image' => 'images/employees/nadim.jpg',
            ],
                        [
                'name' => 'Reza',
                'designation' => 'Sub Editor',
                'weekly_offday' => 'Thursday',
                'profile_image' => 'images/employees/reza.jpg',
            ],
                        [
                'name' => 'Habib',
                'designation' => 'Sub Editor',
                'weekly_offday' => 'Thursday',
                'profile_image' => 'images/employees/sukomal.jpg',
            ],
            [
                'name' => 'Papri',
                'designation' => 'Sub Editor',
                'weekly_offday' => 'Tuesday',
                'profile_image' => 'images/employees/papri.jpg',
            ],
                        [
                'name' => 'Shefarul',
                'designation' => 'Sub Editor',
                'weekly_offday' => 'Tuesday',
                'profile_image' => 'images/employees/shefarul.jpg',
            ],
            [
                'name' => 'Shahajada',
                'designation' => 'Artist',
                'weekly_offday' => 'Sunday',
                'profile_image' => 'images/employees/shahajada.jpg',
            ],
            [
                'name' => 'Avijeet',
                'designation' => 'Artist',
                'weekly_offday' => 'Monday',
                'profile_image' => 'images/employees/avijeet.jpg',
            ],
        ]);
    }
}
