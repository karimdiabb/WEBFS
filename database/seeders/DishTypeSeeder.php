<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DishType;

class DishTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dishTypes = [
            'SOEP',
            'VOORGERECHT',
            'BAMI EN NASI GERECHTEN',
            'COMBINATIE GERECHTEN',
            'MIHOEN GERECHTEN',
            'CHINESE BAMI GERECHTEN',
            'INDISCHE GERECHTEN',
            'EIERGERECHTEN',
            'GROENTEN GERECHTEN',
            'VLEES GERECHTEN',
            'KIP GERECHTEN',
            'GARNALEN GERECHTEN',
            'OSSENHAAS GERECHTEN',
            'VISSEN GERECHTEN',
            'PEKING EEND GERECHTEN',
            'TIEPAN SPECIALITEITEN',
            'VEGETARISCHE GERECHTEN',
            'KINDERMENUS',
            'RIJSTTAFELS',
            'BUFFET',
            'DIVERSEN'
        ];

        foreach ($dishTypes as $type) {
            DishType::create(['DishTypeName' => $type]);
        }
    }
}
