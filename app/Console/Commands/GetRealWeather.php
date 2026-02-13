<?php

namespace App\Console\Commands;

use App\Models\City;
use App\Models\Forecast;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetRealWeather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'weather:get-real {city}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To sync real life weather using Open API';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        /*
        $url= "https://reqres.in/api/users?page=2";
        $response = Http::get($url);
        $jsonResponse = $response->body();

        $jsonResponse = json_decode($jsonResponse, true);

        dd($jsonResponse); */

        $city = City::where(['name' => $this->argument('city')])->first();

        if ($city && $city->todaysForecast()->exists()) {
            return 0;
        }

        $response = Http::get("http://api.weatherapi.com/v1/forecast.json", [
            "key" => $_ENV['API_KEY'],
            "q" => $this->argument('city'), 
            'lang' => 'sr',
            'days' => 5
        ]);
        $jsonResponse = $response->json();
        //dd($jsonResponse);

        if(isset($jsonResponse['error'])) {
            $this->output->error($jsonResponse['error']['message']); //"Ovaj grad ne postoji"
            return 1;
        }

        if($city === null) {
            $city =  City::create([
                'name' => $this->argument('city')
            ]);
        }

        if(!$city->todaysForecast()->exists()) {
            foreach($jsonResponse['forecast']['forecastday'] as $day) {
                Forecast::create([
                    'city_id' => $city->id,
                    'temperature' => $day['day']['maxtemp_c'],
                    'date' => $day['date'],
                    'weather_type' => $day['day']['condition']['text'],
                    'probability' => $day['day']['daily_chance_of_rain']
                ]);
            }
        }

        $sunrise = $jsonResponse['forecast']['forecastday'][0]['astro']['sunrise'];
        $sunset = $jsonResponse['forecast']['forecastday'][0]['astro']['sunset'];
        $this->output->comment("Izlazak Sunca: $sunrise / Zalazak: $sunset");
        return 0;
    }
}
