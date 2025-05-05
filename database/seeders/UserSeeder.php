<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'dev@gmail.com',
            'mobile' => '1111111111', // Ensure unique mobile
            'password' => Hash::make('dev'), // Use a strong password in production
            'utype' => 'ADM', // Set user type to Admin
            'email_verified_at' => now(),
        ]);

        // Create a Regular User
        User::create([
            'name' => 'Regular User',
            'email' => 'user@gmail.com',
            'mobile' => '2222222222', // Ensure unique mobile
            'password' => Hash::make('user'), // Use a strong password in production
            'utype' => 'USR', // Set user type to User
            'email_verified_at' => now(),
        ]);

        // Optionally, create more users using the factory
        // User::factory(5)->create();
    }
}