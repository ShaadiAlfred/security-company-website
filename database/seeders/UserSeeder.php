<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'              => 'Admin',
            'email'             => 'admin@admin.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('password'),
            'role_id'           => Role::whereName('Admin')->first()->id,
            'remember_token'    => Str::random(10),
        ]);
        $this->command->info('Admin user was created!');

        // Moderators
        User::factory()->count(5)->create([
            'role_id' => Role::whereName('Moderator')->first()->id,
        ]);
        $this->command->info('5 moderators were created!');
    }
}
