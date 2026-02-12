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
    protected $signature = 'weather:get-real';

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

        $response = Http::get("http://api.weatherapi.com/v1/current.json", [
            "key" => $_ENV['API_KEY'],
            "q" => 'Novi Sad'
        ]);
        dd($response->json());
    }
}
