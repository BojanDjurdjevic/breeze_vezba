<?php

namespace Database\Seeders;

use App\Models\City;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $amount = $this->command->getOutput()->ask("Koliko gradova želite da ubacite?", 100);

        $faker = Factory::create();
        //dd($faker->city);

        $this->command->getOutput()->progressStart($amount); // progress bar
        for($i = 0; $i < $amount; $i++)
        {
            $found = City::where(['name' => $faker->city])->first();
            if($found !== null) 
            {
                $this->command->getOutput()->error("Ovaj grad već postoji");
                continue;
            }
            City::create([
                'name' => $faker->city
            ]);

            $this->command->getOutput()->progressAdvance();
        }

        $this->command->getOutput()->progressFinish();
    }
}
