<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'category_id' => 'cat-001', 
                'name' => 'Electronics',
                'slug' => Str::slug('Electronics'),
                'image' => 'default-category.png', 
                'parent_id' => null, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 'cat-002', 
                'name' => 'Mobile Phones',
                'slug' => Str::slug('Mobile Phones'),
                'image' => 'default-category.png', 
                'parent_id' => 'cat-001', 
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}