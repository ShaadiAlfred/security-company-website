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
    }
}
