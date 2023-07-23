<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

    protected $table = 'addresses';
    public $timestamps = true;

    public function profile()
    {
        return $this->belongsTo('App\Models\Profile', 'profile_id');
    }

    public function city()
    {
        return $this->belongsTo('App\City', 'city_id');
    }

    public function region()
    {
        return $this->belongsTo('App\Region', 'region_id');
    }
}