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
        ]);
        Employee::create([
            'number' => 1002,
            'name' => 'Ameer Nagi',
            'job_location_id' => 2,
        ]);
    }
}
