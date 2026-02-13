<?php

namespace App\Http;

class ForecastHelper 
{
    public static function getColorByTemp($temperature)
    {
        $boja = '';

        if($temperature <= 0) $boja = 'text-blue-400';
        elseif($temperature >= 0 && $temperature <= 15) $boja = 'text-blue-500';
        elseif($temperature > 15 && $temperature <= 25) $boja = 'text-emerald-500';
        else $boja = 'text-red-600';

        return $boja;
    }

    public static function getIcon($type)
    {
        $icon = '';
        if($type == 'rainy') $icon = 'mdi-weather-rainy';
        elseif($type == 'sunny') $icon = 'mdi-weather-sunny';
        elseif($type == 'snowy') $icon = 'mdi-weather-snowy';
        elseif($type == 'cloudy') $icon = 'mdi-weather-cloudy';
        else $icon = 'mdi-weather-sunny';

        return $icon;
    }
}