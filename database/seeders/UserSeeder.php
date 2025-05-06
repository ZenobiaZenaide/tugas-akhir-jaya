<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'id' => 'admin-001', // Manually provided string ID
                'name' => 'Test Admin',
                'email' => 'dev@gmail.com',
                'mobile' => '1234567890',
                'email_verified_at' => now(),
                'password' => Hash::make('dev'),
                'utype' => 'ADM', // Or 'ADM' for admin
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 'user-001', // Manually provided string ID
                'name' => 'Test User',
                'email' => 'user@gmail.com',
                'mobile' => '1234567830',
                'email_verified_at' => now(),
                'password' => Hash::make('user'),
                'utype' => 'USR', // Or 'ADM' for admin
                'remember_token' => \Illuminate\Support\Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more users as needed
        ]);
    }
}