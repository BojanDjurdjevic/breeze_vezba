<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\CityWeatherModel;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WeatherSeader extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $city = City::all();
        $faker = Factory::create();

        foreach ($city as $c)
        {
            
            CityWeatherModel::create([
                'city_id' => $c->id,
                'temp' => $faker->randomFloat(1, 0, 40)
            ]);
        }
    }
}
