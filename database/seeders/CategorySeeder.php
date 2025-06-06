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
                'category_id' => 'cat-001', // Changed from 'id'
                'name' => 'Electronics',
                'slug' => Str::slug('Electronics'),
                'image' => 'default-category.png', // Optional
                'parent_id' => null, // Or provide a parent category ID if it's a subcategory
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 'cat-002', // Changed from 'id'
                'name' => 'Mobile Phones',
                'slug' => Str::slug('Mobile Phones'),
                'image' => 'default-category.png', // Optional
                'parent_id' => 'cat-001', // Example of a subcategory
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more categories as needed
        ]);
    }
}