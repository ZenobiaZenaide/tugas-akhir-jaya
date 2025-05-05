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

        // Iterate and create records using the MonthName model
        // The HasUuids trait in the model will automatically generate the UUID
        foreach ($months as $month) {
            MonthName::create($month);
        }

        // DB::table('month_names')->insert($months); // Remove or comment out the old DB facade insert
    }
}
