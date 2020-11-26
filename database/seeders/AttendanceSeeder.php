<?php

namespace Database\Seeders;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = Carbon::now();

        // 12 hours shift
        for ($i = 0; $i < 6; ++$i) {

            Attendance::create([
                'employee_id' => 1,
                'is_present' => rand(0, 1),
                'submitted_by' => 2,
                'submitted_from' => '4A، حارة طارق ابو الليل، عين شمس، القاهرة',
                'latitude' => 30.1289516,
                'longitude' => 31.3289385,
                'created_at' => $date,
                'updated_at' => $date,
            ]);

            Attendance::create([
                'employee_id' => 2,
                'is_present' => rand(0, 1),
                'submitted_by' => 2,
                'submitted_from' => '4A، حارة طارق ابو الليل، عين شمس، القاهرة',
                'latitude' => 30.1289516,
                'longitude' => 31.3289385,
                'created_at' => $date,
                'updated_at' => $date,
            ]);

            $date = $date->addHours(2);
        }

        // 6 hours shift on another day
        $date = Carbon::now()->addDay(1);

        for ($i = 0; $i < 3; ++$i) {

            Attendance::create([
                'employee_id' => 1,
                'is_present' => rand(0, 1),
                'submitted_by' => 2,
                'submitted_from' => '4A، حارة طارق ابو الليل، عين شمس، القاهرة',
                'latitude' => 30.1289516,
                'longitude' => 31.3289385,
                'created_at' => $date,
                'updated_at' => $date,
            ]);

            Attendance::create([
                'employee_id' => 2,
                'is_present' => rand(0, 1),
                'submitted_by' => 2,
                'submitted_from' => '4A، حارة طارق ابو الليل، عين شمس، القاهرة',
                'latitude' => 30.1289516,
                'longitude' => 31.3289385,
                'created_at' => $date,
                'updated_at' => $date,
            ]);

            $date = $date->addHours(2);
        }

        // Another month
        $date = Carbon::now()->addMonth();
        // 12 hours shift
        for ($i = 0; $i < 6; ++$i) {

            Attendance::create([
                'employee_id' => 1,
                'is_present' => rand(0, 1),
                'submitted_by' => 2,
                'submitted_from' => '4A، حارة طارق ابو الليل، عين شمس، القاهرة',
                'latitude' => 30.1289516,
                'longitude' => 31.3289385,
                'created_at' => $date,
                'updated_at' => $date,
            ]);

            Attendance::create([
                'employee_id' => 2,
                'is_present' => rand(0, 1),
                'submitted_by' => 2,
                'submitted_from' => '4A، حارة طارق ابو الليل، عين شمس، القاهرة',
                'latitude' => 30.1289516,
                'longitude' => 31.3289385,
                'created_at' => $date,
                'updated_at' => $date,
            ]);

            $date = $date->addHours(2);
        }

        // 6 hours shift on another day
        $date = Carbon::now()->addDay(1);

        for ($i = 0; $i < 3; ++$i) {

            Attendance::create([
                'employee_id' => 1,
                'is_present' => rand(0, 1),
                'submitted_by' => 2,
                'submitted_from' => '4A، حارة طارق ابو الليل، عين شمس، القاهرة',
                'latitude' => 30.1289516,
                'longitude' => 31.3289385,
                'created_at' => $date,
                'updated_at' => $date,
            ]);

            Attendance::create([
                'employee_id' => 2,
                'is_present' => rand(0, 1),
                'submitted_by' => 2,
                'submitted_from' => '4A، حارة طارق ابو الليل، عين شمس، القاهرة',
                'latitude' => 30.1289516,
                'longitude' => 31.3289385,
                'created_at' => $date,
                'updated_at' => $date,
            ]);

            $date = $date->addHours(2);
        }
    }
}
