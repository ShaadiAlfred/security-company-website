<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::create([
            'number' => 1001,
            'name' => 'Shaadi Alfred',
            'job_location_id' => 1,
            'job_shift_id' => 1,
        ]);

        Employee::create([
            'number' => 1002,
            'name' => 'Ameer Nagi',
            'job_location_id' => 2,
            'job_shift_id' => 2,
        ]);

        Employee::create([
            'number' => 1003,
            'name' => 'Ahmed Mahmoud',
            'job_location_id' => 2,
            'job_shift_id' => 3,
        ]);
    }
}
