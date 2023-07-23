<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryType extends Model
{

    protected $table = 'delivery_types';
    public $timestamps = true;

    public function cities()
    {
        return $this->belongsToMany('App\City', 'rates');
    }

    public function deliveries()
    {
        return $this->hasMany('App\Models\Delivery');
    }

}