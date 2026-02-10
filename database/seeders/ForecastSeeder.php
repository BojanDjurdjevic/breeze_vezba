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

        $type = ['rainy', 'sunny', 'snowy', 'cloudy'];

        $tempAllow = [
            'rainy' => ['min' => -3, 'max' => 40],
            'sunny' => ['min' => -10, 'max' => 40],
            'snowy' => ['min' => -2, 'max' => 2],
            'cloudy' => ['min' => -10, 'max' => 15],
        ];

        foreach($cities as $c)
        {
            $startDate = new DateTime();
            $saveTemp = null;
            for($i = 1; $i < 6; $i++)
            {
                $date = (clone $startDate)->modify("+$i day");
                $num = random_int(0, 3);
                $wt = $type[$num];
                $probability = random_int(0, 100);
                if($wt === 'sunny') 
                {
                    $probability = null;      
                }

                $min = $tempAllow[$wt]['min'];
                $max = $tempAllow[$wt]['max'];

                if ($saveTemp !== null) {
                    $min = max($min, $saveTemp - 5);
                    $max = min($max, $saveTemp + 5);
                }

                if($min > $max) {
                    [$min, $max] = [$max, $min];
                }

                $temp = $faker->randomFloat(1, $min, $max);

                $saveTemp = $temp;

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
