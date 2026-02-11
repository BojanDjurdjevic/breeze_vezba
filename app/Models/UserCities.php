<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCities extends Model
{
    protected $table = 'user_cities';

    protected $fillable = [
        'city_id', 'user_id'
    ];

    public function users() 
    {
        return $this->hasbelongsToMany(User::class);
    }

    public function city() 
    {
        return $this->belongsTo(City::class);
    }
}
