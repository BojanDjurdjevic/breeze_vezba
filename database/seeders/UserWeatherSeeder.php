<?php

namespace Database\Seeders;

use App\Models\CityWeatherModel;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserWeatherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $city = $this->command->getOutput()->ask("Koji grad želite da ubacite?");
        if($city === null) 
        {
            $this->command->getOutput()->error("Niste uneli ime grada");
        }

        $found = CityWeatherModel::where(['city' => $city])->first();

        if($found)
        {
            $this->command->getOutput()->error("Grad koji ste uneli već postoji! Unesite drugi.");
        }

        $temp = $this->command->getOutput()->ask('Koju temperaturu želite da dodelite?');
        if($temp === null)
        {
            $this->command->getOutput()->error("Niste uneli temperaturu!");
        }

        

        dd('Grad: '. $city . "\n" . 'Temperatura: '. $temp);

        //$faker = Factory::create('hr_HR');
        CityWeatherModel::create([
            'city' => $city,
            'temp' => $temp
        ]);

        $this->command->getOutput()->info("Uspešno ste uneli novi grad $city sa temperaturom od $temp C !");
    }
}
