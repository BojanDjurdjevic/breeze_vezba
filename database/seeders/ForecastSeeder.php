<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Forecast;
use DateTime;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ForecastSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = City::all();
        
        $faker = Factory::create();

        foreach($cities as $c)
        {
            $startDate = new DateTime();
            for($i = 0; $i < 5; $i++)
            { 
                $temp = $faker->randomFloat(1, -10, 42);
                $date = (clone $startDate)->modify("+$i day");
                Forecast::create([
                    'city_id' => $c->id,
                    'temperature' => $temp,
                    'date' => $date->format('Y-m-d')
                ]);
            }
        }
    }
}
