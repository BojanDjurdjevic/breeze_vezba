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

        $type = ['rainy', 'sunny', 'snowy'];

        foreach($cities as $c)
        {
            $startDate = new DateTime();
            for($i = 1; $i < 6; $i++)
            { 
                $temp = $faker->randomFloat(1, -10, 42);
                $date = (clone $startDate)->modify("+$i day");
                $num = random_int(0, 2);
                $wt = $type[$num];
                $probability = random_int(0, 100);
                if($wt === 'sunny') 
                {
                    $probability = null;
                }

                Forecast::create([
                    'city_id' => $c->id,
                    'temperature' => $temp,
                    'date' => $date->format('Y-m-d'),
                    'weather_type' => $wt,
                    'probability' => $probability
                ]);
            }
        }
    }
}
