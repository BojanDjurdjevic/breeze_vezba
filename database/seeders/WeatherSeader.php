<?php

namespace Database\Seeders;

use App\Models\CityWeatherModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WeatherSeader extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prognoza = [
            'Kikinda' => 11,
            'Vršac' => 15,
            'Valjevo' => 12,
            'Kragujevac' => 10,
            'Kraljevo' => 15,
            'Zrenjanin' => 9,
            'Šabac' => 9,
            'Loznica' => 11,
            'Negotin' => 8,
            'Bor' => 10,
            'Novi Pazar' => 9
        ];

        foreach ($prognoza as $city => $temp)
        {
            CityWeatherModel::create([
                'city' => $city,
                'temp' => $temp
            ]);
        }
    }
}
