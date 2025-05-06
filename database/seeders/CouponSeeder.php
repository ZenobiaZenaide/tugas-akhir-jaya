<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('coupons')->insert([
            [
                'coupon_id' => 'coupon-001', // Changed from 'id'
                'code' => 'SUMMER20',
                'type' => 'percent', // 'fixed' or 'percent'
                'value' => 10, // Percentage or fixed amount
                'cart_value' => 50, // Minimum cart value to apply coupon
                'expiry_date' => now()->addMonths(3)->toDateString(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Add more coupons as needed
        ]);
    }
}