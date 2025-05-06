<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('slides')->insert([
            [
                'id' => 'slide-001', // Manually provided string ID
                'tagline' => 'New Arrivals',
                'title' => 'Check Out Our Latest Collection',
                'subtitle' => 'Fresh styles just for you!',
                'link' => '/shop',
                'image' => 'slide1.jpg', // Provide an image name/path
                'status' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more slides as needed
        ]);
    }
}