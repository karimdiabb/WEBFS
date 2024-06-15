<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tables = [];

        for($i = 1; $i <= 20; $i++)
        {
            $tables[] = [
                'Name' => 'Tafel ' . $i
            ];
        }

        DB::table('restaurant_tables')->insert($tables);
    }
}
