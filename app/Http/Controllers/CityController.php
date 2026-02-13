<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\CityWeatherModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CityController extends Controller
{
    public function index()
    {
        $cities = City::all();

        $userFavourites = [];
        if(Auth::check()) {
            $userFavourites = Auth::user()->cityFavourites;
            $userFavourites = $userFavourites->pluck('city_id')->toArray(); // pluck() vraća samo određeni podatak (city_id)
        }
        return view('admin.cities', compact('cities', 'userFavourites'));
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'city' => 'required|string|min:3',
            'temp' => 'required|integer'
        ]);

        CityWeatherModel::create($validated);

        return redirect()->route('admin.cities')->with('success', 'Uspešno ste dodali novi grad!');
    }

    public function apiCall() 
    {
        
    }

    public function update(Request $request)
    {
        
        $validated = $request->validate([
            'city_id' => 'required|exists:cities,id',
            'temp' => 'required|integer'
        ]);

        $weather = CityWeatherModel::where(['city_id' => $request->get('city_id')])->first();
        $city = $weather->city->name;

        $weather->update($validated);

        return redirect()->route('admin.cities')->with('success', "Uspešno ste ažurirali temperaturu za grad: $city");
    }

    public function delete(CityWeatherModel $city)
    {
        $city->delete();

        return redirect()->route('admin.cities')->with('success', 'Uspešno ste obrisali grad!');
    }
}
