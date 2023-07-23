<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{

    protected $table = 'deliveries';
    public $timestamps = true;

    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }

    public function deliveryType()
    {
        return $this->belongsTo('App\Models\DeliveryType', 'deliveryType_id');
    }

}