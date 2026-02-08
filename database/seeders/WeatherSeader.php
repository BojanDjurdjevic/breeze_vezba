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
            'Sombor' => 15,
            'Bačka Palanka' => 12,
            'Surdulica' => 10,
            'Gornji Milanovac' => 15,
        ];

        foreach ($prognoza as $city => $temp)
        {
            $cityWeather = CityWeatherModel::where(['city' => $city])->first();

            if($cityWeather !== null) {
                $this->command->getOutput()->error("Grad $cityWeather->city već postoji");
                continue; // preskače ga
            }

            CityWeatherModel::create([
                'city' => $city,
                'temp' => $temp
            ]);
        }
    }
}
