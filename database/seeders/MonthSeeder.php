<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MonthName; // Import the MonthName model

class MonthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $months = [
            ['name' => 'January'],
            ['name' => 'February'],
            ['name' => 'March'],
            ['name' => 'April'],
            ['name' => 'May'],
            ['name' => 'June'],
            ['name' => 'July'],
            ['name' => 'August'],
            ['name' => 'September'],
            ['name' => 'October'],
            ['name' => 'November'],
            ['name' => 'December'],
        ];


        foreach ($months as $month) {
            MonthName::create($month);
        }

    }
}
