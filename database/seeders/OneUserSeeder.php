<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class OneUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $name = $this->command->getOutput()->ask("Unesite korisničko ime");
        if($name === null) 
        {
            $this->command->getOutput()->error("Niste uneli ime korisnika!");
            return;
        }

        $email = $this->command->getOutput()->ask("Unesite korisnički email");
        if($email === null) 
        {
            $this->command->getOutput()->error("Niste uneli email korisnika!");
            return;
        }
        $found = User::where(['email' => $email])->first();
        if($found instanceof User) // ja stavio samo $found - radi, ali ovako je bolje 
        {
            $this->command->getOutput()->error("Ovaj korisnik već postoji");
            return;
        }

        $pass = $this->command->getOutput()->ask('Koju korisničku šifru želite da dodelite?', 'BojanTest333');

        //dd('Ime korisnika: '. $name . "\n" . "Email: " . $email . "\n" . 'Šifra: '. $pass);

        
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($pass)
        ]);

        $this->command->getOutput()->info("Uspešno ste uneli novog korisnika $name");
    }
}
