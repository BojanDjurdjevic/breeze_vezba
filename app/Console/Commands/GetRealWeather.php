<?php

namespace App\Console\Commands;

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

        $response = Http::get("http://api.weatherapi.com/v1/forecast.json", [
            "key" => $_ENV['API_KEY'],
            "q" => $this->argument('city'), 
            'lang' => 'sr',
            'days' => 5
        ]);
        $jsonResponse = $response->json();

        if(isset($jsonResponse['error'])) {
            $this->output->error($jsonResponse['error']['message']); //"Ovaj grad ne postoji"
        }
        dd($jsonResponse);

        return $jsonResponse;
    }
}
