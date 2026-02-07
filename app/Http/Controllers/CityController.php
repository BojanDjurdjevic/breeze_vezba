<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CityWeatherModel;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index()
    {
        $cities = CityWeatherModel::all();
        return view('cities', compact('cities'));
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

    public function update(Request $request, CityWeatherModel $city)
    {
        $request->validate([
            'city' => 'required|string|min:3',
            'temp' => 'required|integer'
        ]);

        $city->city = $request->get('city');
        $city->temp = $request->get('temp');

        $city->save();

        return redirect()->route('admin.cities')->with('success', 'Uspešno ste ažurirali grad!');
    }

    public function delete(CityWeatherModel $city)
    {
        $city->delete();

        return redirect()->route('admin.cities')->with('success', 'Uspešno ste obrisali grad!');
    }
}
