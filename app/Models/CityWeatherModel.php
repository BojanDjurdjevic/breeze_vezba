<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CityWeatherModel extends Model
{
    protected $table = 'CityWeather';

    protected $fillable = [
        'city', 'temp'
    ];
}
