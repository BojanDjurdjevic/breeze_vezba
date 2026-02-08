<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CityWeatherModel;
use Illuminate\Http\Request;

use function Symfony\Component\String\s;

class ForecastController extends Controller
{
    public function index() 
    {

    }

    public function fiveDays($c)
    {

        $cities = [
            'beograd' => [10, 10, 12, 15, 14],
            'novi Sad' => [10, 9, 9, 15, 17],
            'niš' => [8, 8, 16, 12, 15],
            'kragujevac' => [10, 6, 11, 11, 14],
            'zrenjanin' => [9, 16, 16, 13, 14],
            'valjevo' => [7, 10, 15, 12, 14],
        ];
        
        $city = strtolower($c);

        if(array_key_exists($city, $cities)) { //isset($cities[$city])
            $temps = $cities[$city];
            $c = strtoupper($c);
            return view('forecasts', compact('c', 'temps'));
        } else {
            return redirect()->back()->with('error', "Odabrani grad sa imenom $c ne postoji");
        }
    }
}
