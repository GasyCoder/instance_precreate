<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Creating Client User
        $client = User::create([
            'email' => 'client@mail.com',
            'password' => bcrypt('client123'),
            'email_verified_at' => now(),
        ]);
        $client->assignRole('client');

    }
}
