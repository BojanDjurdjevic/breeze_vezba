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
        /*
        $icon = '';
        if($type == 'rainy') $icon = 'mdi-weather-rainy';
        elseif($type == 'sunny') $icon = 'mdi-weather-sunny';
        elseif($type == 'snowy') $icon = 'mdi-weather-snowy';
        elseif($type == 'cloudy') $icon = 'mdi-weather-cloudy';
        else $icon = 'mdi-weather-sunny';

        return $icon; */

        return match($type) {
            'rainy' => 'mdi-weather-rainy',
            'kiša' => 'mdi-weather-rainy',
            'Mestimična kiša' => 'mdi-weather-rainy',
            'Slaba kiša' => 'mdi-weather-rainy',
            'Slaba ledena kiša' => 'mdi-weather-rainy',
            'Umerena kiša' => 'mdi-weather-rainy',
            'sunny' => 'mdi-weather-sunny',
            'Sunčano' => 'mdi-weather-sunny',
            'Pretežno sunčano' => 'mdi-weather-sunny',
            'snowy' => 'mdi-weather-snowy',
            'sneg' => 'mdi-weather-snowy',
            'cloudy' => 'mdi-weather-cloudy',
            'oblačno' => 'mdi-weather-cloudy',
            'Naoblačenje' => 'mdi-weather-cloudy',
            'Mestimično oblačno' => 'mdi-weather-cloudy',
            default => 'mdi-weather-sunny'
        };
    }
}