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
        $attendanceCheckActualTime = Carbon::today()->addDay();

        for ($i = 0; $i < 7; $i++) {
            // First shift ( -> 12)
            $employeeId = 1;

            $attendanceCheckTimestamps = [
                [2, 10],
                [4, 5],
                [6, 2],
                [8, 3],
                [9, 58],
                [12, 9],
            ];

            foreach ($attendanceCheckTimestamps as $attendanceCheckTimestmap) {
                list($hours, $minutes) = $attendanceCheckTimestmap;

                $attendanceCheckActualTime->setTime($hours, $minutes);

                Attendance::create([
                    'employee_id' => $employeeId,
                    'is_present' => 1,
                    'submitted_by' => 2,
                    'submitted_from' => '4A، حارة طارق ابو الليل، عين شمس، القاهرة',
                    'latitude' => 30.1289516,
                    'longitude' => 31.3289385,
                    'created_at' => $attendanceCheckActualTime,
                    'updated_at' => $attendanceCheckActualTime,
                ]);
            }

            // Second shift (12 -> 24)

            $employeeId = 2;

            $attendanceCheckActualTime = Carbon::today()->addDay();

            $attendanceCheckTimestamps = [
                [14, 0],
                [16, 8],
                [18, 1],
                [19, 56],
                [22, 10],
                [24, 2],
            ];

            foreach ($attendanceCheckTimestamps as $attendanceCheckTimestmap) {
                list($hours, $minutes) = $attendanceCheckTimestmap;

                $attendanceCheckActualTime->setTime($hours, $minutes);

                Attendance::create([
                    'employee_id' => $employeeId,
                    'is_present' => 1,
                    'submitted_by' => 2,
                    'submitted_from' => '4A، حارة طارق ابو الليل، عين شمس، القاهرة',
                    'latitude' => 30.1289516,
                    'longitude' => 31.3289385,
                    'created_at' => $attendanceCheckActualTime,
                    'updated_at' => $attendanceCheckActualTime,
                ]);
            }


            // Third shift (7 -> 19)

            $employeeId = 3;

            $attendanceCheckActualTime = Carbon::today()->addDay();

            $attendanceCheckTimestamps = [
                [9, 10],
                [11, 5],
                [13, 2],
                [15, 1],
                [16, 55],
                [19, 10],
            ];

            foreach ($attendanceCheckTimestamps as $attendanceCheckTimestmap) {
                list($hours, $minutes) = $attendanceCheckTimestmap;

                $attendanceCheckActualTime->setTime($hours, $minutes);

                Attendance::create([
                    'employee_id' => $employeeId,
                    'is_present' => 1,
                    'submitted_by' => 2,
                    'submitted_from' => '4A، حارة طارق ابو الليل، عين شمس، القاهرة',
                    'latitude' => 30.1289516,
                    'longitude' => 31.3289385,
                    'created_at' => $attendanceCheckActualTime,
                    'updated_at' => $attendanceCheckActualTime,
                ]);
            }

            $attendanceCheckActualTime->addDay();
        }

    }
}
