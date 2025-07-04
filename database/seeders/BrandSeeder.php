<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('brands')->insert([
            [
                'brand_id' => 'brand-001',
                'name' => 'Awesome Brand',
                'slug' => Str::slug('Awesome Brand'),
                'image' => 'default-brand.png', 
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}