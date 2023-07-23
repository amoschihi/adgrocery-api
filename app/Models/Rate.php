<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{

    protected $table = 'rates';
    public $timestamps = true;

    public function city()
    {
        return $this->belongsTo('App\City', 'city_id');
    }

    public function deliveryType()
    {
        return $this->belongsTo('App\Models\DeliveryType', 'deliveryType_id');
    }

}