<?php

namespace Database\Seeders;

use App\Models\JobShift;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class JobShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JobShift::create([
            'name' => 'شيفت 1',
            'start' => Carbon::createFromTime(00),
            'end' => Carbon::createFromTime(12),
        ]);

        JobShift::create([
            'name' => 'شيفت 2',
            'start' => Carbon::createFromTime(12),
            'end' => Carbon::createFromTime(24),
        ]);

        JobShift::create([
            'name' => 'شيفت 3',
            'start' => Carbon::createFromTime(07),
            'end' => Carbon::createFromTime(19),
        ]);
    }
}
