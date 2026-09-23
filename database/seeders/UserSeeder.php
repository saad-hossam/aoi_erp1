<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {

        // Create admin
        User::factory()->create([
            'name' => 'Admin ',
            'email' => 'admin@gmail.com',
            'utype' => 'ADM',
            'password' => bcrypt('12345678'),
        ]);
    }
}
