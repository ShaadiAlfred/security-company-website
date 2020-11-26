<?php

namespace Database\Seeders;

use App\Models\JobLocation;
use Illuminate\Database\Seeder;

class JobLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JobLocation::create([
            'name' => 'القاهرة',
            'hourly_wage' => 15.00,
        ]);

        JobLocation::create([
            'name' => 'الجيزة',
            'hourly_wage' => 35.00,
        ]);
    }
}
