<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $table = 'orders';
    public $timestamps = true;

    public function profile()
    {
        return $this->belongsTo('App\models\Profile', 'profile_id');
    }

    public function products()
    {
        return $this->belongsToMany('App\models\Product', 'line_orders');
    }

    public function payment()
    {
        return $this->hasOne('App\Models\Payment');
    }

    public function delivery()
    {
        return $this->hasOne('App\Models\Delivery');
    }

    public function line_orders()
    {
        return $this->hasMany('App\Models\LineOrder');
    }

}