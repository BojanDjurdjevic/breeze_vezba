<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\User;
use App\Models\UserCities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCitiesController extends Controller
{
    public function favourite($city)
    {
        if(!Auth::user()) { // if (Auth::user() === null)
            return redirect('/login')->with('error', 'Morate biti ulogovani da biste izabrali omiljeni grad!');
        }
        
        $userCity = [
            'city_id' => $city,
            'user_id' => Auth::user()->id
        ];

        //dd($userCity);
        UserCities::create($userCity);
        return redirect()->back()->with('success', 'Uspešno ste dodali grad na listu omiljenih');
    }

    public function rmFavourite(City $city)
    {
        if(!Auth::user()) { // if (Auth::user() === null)
            return redirect('/login')->with('error', 'Morate biti ulogovani da biste skinuli grad sa liste omiljenih!');
        }

        UserCities::where(['city_id' => $city->id, 'user_id' => Auth::id()])->first()->delete();

        return redirect()->back()->with('success', "Uspešno ste obrisali grad $city->name sa liste omiljenih");
    }
}
