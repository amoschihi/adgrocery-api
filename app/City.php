<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //
    public function addresses()
    {
        return $this->hasMany('App\Models\Address');
    }

    public function deliveryType()
    {
        return $this->belongsToMany('App\Models\DeliveryType', 'rates');
    }

}
