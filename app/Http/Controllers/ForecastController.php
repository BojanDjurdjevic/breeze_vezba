<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\CityWeatherModel;
use Illuminate\Http\Request;

use function Symfony\Component\String\s;

class ForecastController extends Controller
{
    public function index() 
    {

    }

    public function fiveDays(City $city)
    {
        //$cityForecasts = $city->forecasts()->get();

        return view('forecasts', compact('city'));
    }
}
