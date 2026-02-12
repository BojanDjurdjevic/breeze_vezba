<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-command {city}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        /*
        $response = Http::get("https://reqres.in/api/users/2");
        dd($response->json());
        */

        $response = Http::get("http://api.weatherapi.com/v1/forecast.json", [
            "key" => $_ENV['API_KEY'],
            "q" => $this->argument("city"),
            "aqi" => "no",
            'days' => 5,
            'lang' => 'sr',
            'forecastday' => 5
        ]);

        $jsonResponse = $response->json();

        if(isset($jsonResponse['error'])) {
            $this->output->error($jsonResponse['error']['message']); //"Ovaj grad ne postoji"
        }

        dd($jsonResponse);
    }
}
