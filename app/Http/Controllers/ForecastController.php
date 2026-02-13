<?php

namespace App\Http\Controllers;

use App\Console\Commands\GetRealWeather;
use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\CityWeatherModel;
use App\Models\Forecast;
use App\Models\UserCities;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth as FacadesAuth;

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

        $cities = City::with('todaysForecast')->where('name', "LIKE", "%$cityName%")->get();

        if(count($cities) === 0) {
            return redirect('/')->with('error', "Grad koji sadrži slova $cityName ne postoji!");
        }

        $userFavourites = [];
        if(FacadesAuth::check()) {
            $userFavourites = FacadesAuth::user()->cityFavourites;
            $userFavourites = $userFavourites->pluck('city_id')->toArray(); // pluck() vraća samo određeni podatak (city_id)
        }
        

        return view("search-result", compact('cities', 'userFavourites'));
    }

    public function results(City $city)
    {
        
        return view('one-forecasts', compact('city'));
    }

    public function apiCall(Request $request)
    {
        $apiCommand = Artisan::call('weather:get-real', [
            'city' => $request->get('city')
        ]);  

        $output = Artisan::output();

        if($apiCommand !== 0) {
            return redirect()->back()->with('error', $output);
        }

        $myCity = City::where(['name' => $request->get('city')])->first();

        return view('search-forecasts', compact('myCity'));

        /*
        dd($apiCommand);

        if($apiCommand['error']) {
            dd($apiCommand['error']);
        }

        if($city === null) {
            die('Ne postoji grad u bazi');
            $validated = $request->validate([
                'name' => 'required|string'
            ]);
            $newCity =  City::create($validated);

            foreach($apiCommand['forecast']['forecastday'] as $day) {
                Forecast::create([
                    'city_id' => $newCity->id,
                    'temperature' => $day['day']['maxtemp_c'],
                    'date' => $day['date'],
                    'weather_type' => $day['day']['condition']['text'],
                    'probability' => $day['day']['daily_chance_of_rain']
                ]);
            }
            
        }

        if($city->todaysForecast()) {
            die('Ima prognoza za danas!');
        } */
    }
}
