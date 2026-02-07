<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CityWeatherModel extends Model
{
    protected $table = 'city_weather';

    protected $fillable = [
        'city', 'temp'
    ];
}
