<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WeatherService 
{
    public function getForecast($city)
    {
        $response = Http::get("http://api.weatherapi.com/v1/forecast.json", [
            "key" => $_ENV['API_KEY'],
            "q" => $city, 
            'lang' => 'sr',
            'days' => 5
        ]);

        return $response->json();
    }

    public function getAstro($city)
    {
        $response = Http::get("http://api.weatherapi.com/v1/astronomy.json", [
            "key" => $_ENV['API_KEY'],
            "q" => $city, 
            'lang' => 'sr',
            'days' => 5
        ]);

        return $response->json();
    }
}