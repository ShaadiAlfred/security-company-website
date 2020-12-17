<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([RoleSeeder::class]);
        $this->command->info('Roles table has been seeded!');
        $this->call([UserSeeder::class]);
        $this->command->info('Users table has been seeded!');
        $this->call([JobLocationSeeder::class]);
        $this->command->info('Job locations table has been seeded!');
        $this->call([JobShiftSeeder::class]);
        $this->command->info('Job shifts table has been seeded!');
        $this->call([EmployeeSeeder::class]);
        $this->command->info('Employees table has been seeded!');
        $this->call([AttendanceSeeder::class]);
        $this->command->info('Attendace table has been seeded!');
    }
}
