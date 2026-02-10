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

        //novo
        $tempAllow = ['min' => -10, 'max' => 40];

        $type = ['rainy', 'sunny', 'snowy', 'cloudy'];

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
                    $saveTemp != null ? 
                    $temp = $faker->randomFloat(1, $saveTemp - 5, $saveTemp + 5) : $temp = $faker->randomFloat(1, -10, 40);
                    
                }
                elseif($wt === 'cloudy') 
                {
                    $saveTemp != null ? 
                    $temp = $faker->randomFloat(1, $saveTemp - 5, $saveTemp + 5) :
                    $temp = $faker->randomFloat(1, -10, 15);
                }
                elseif($wt === 'rainy') 
                {
                    $saveTemp != null ? 
                    $temp = $faker->randomFloat(1, $saveTemp - 5, $saveTemp + 5) :
                    $temp = $faker->randomFloat(1, -3, 40);
                }
                elseif($wt === 'snowy') 
                {
                    $saveTemp != null ? 
                    $temp = $faker->randomFloat(1, $saveTemp - 5, $saveTemp + 5) :
                    $temp = $faker->randomFloat(1, -2, 1);
                }

                //novo
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
