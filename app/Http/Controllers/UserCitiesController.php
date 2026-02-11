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
    public function favourite(Request $request, $city)
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
}
