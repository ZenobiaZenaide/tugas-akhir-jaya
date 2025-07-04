<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'product_id' => 'prod-001', 
                'name' => 'Sample Product One',
                'slug' => Str::slug('Sample Product One'),
                'short_description' => 'This is a short description for sample product one.',
                'description' => 'This is a longer, more detailed description for sample product one.',
                'regular_price' => 199.99,
                'sale_price' => 179.99,
                'SKU' => 'SP001',
                'stock_status' => 'instock',
                'featured' => true,
                'quantity' => 50,
                'image' => 'default-product.png', 
                'images' => null, 
                'category_id' => 'cat-002', 
                'brand_id' => 'brand-001',  
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}