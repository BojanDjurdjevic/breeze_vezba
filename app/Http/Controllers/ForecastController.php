<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\CityWeatherModel;
use App\Models\Forecast;
use Illuminate\Http\Request;

use function Symfony\Component\String\s;

class ForecastController extends Controller
{
    public function index() 
    {
        //$forecasts = Forecast::with('city')->get()->groupBy('city_id');
        $cities = City::all();
        //dd($forecasts);
        return view('admin.add-forecast', compact( 'cities'));
    }

    public function fiveDays(City $city)
    {
        //$cityForecasts = $city->forecasts()->get();

        return view('forecasts', compact('city'));
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'city_id' => 'required|exists:cities,id',
            'temperature' => 'required|integer',
            'date' => 'required|string',
            'weather_type' => 'required|string',
            'probability' => 'nullable'
        ]);

        Forecast::create($validated);
        //Forecast::create($request->all()); // može i ovako

        return redirect()->route('all-forecasts')->with('success', 'Uspešno ste dodali prognozu.');
    }

    public function search(Request $request) 
    {
        $cityName = $request->get('city');

        $cities = City::where('name', "LIKE", "%$cityName%")->get();

        if(count($cities) === 0) {
            return redirect('/')->with('error', "Grad koji sadržis slova $cityName ne postoji!");
        }

        return view("search-result", compact('cities'));
    }

    public function results(City $city)
    {
        
        return view('one-forecasts', compact('city'));
    }
}
