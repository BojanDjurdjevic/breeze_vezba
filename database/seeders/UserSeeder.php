<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $amount = $this->command->getOutput()->ask("Koliko korisnika želite da ubacite?", 50);

        $pass = $this->command->getOutput()->ask('Koju korisničku šifru želite da dodelite?', 'BojanTest333');

        dd('Broj korisnika: '. $amount . "\n" . 'Šifra: '. $pass);

        $faker = Factory::create('hr_HR');
        dd($faker->name);

        $this->command->getOutput()->progressStart($amount); // progress bar
        for($i = 0; $i < $amount; $i++)
        {
            $found = User::where(['email' => $faker->email]);
            if($found) 
            {
                $this->command->getOutput()->error("Ovaj korisnik već postoji");
                return;
            }
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => Hash::make($pass)
            ]);

            $this->command->getOutput()->progressAdvance();
        }

        $this->command->getOutput()->progressFinish();
    }
}
