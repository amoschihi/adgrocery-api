<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LineOrder extends Model
{

    protected $table = 'line_orders';
    public $timestamps = true;

    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'order_id');
    }

    public function profile()
    {
        $this->belongsTo('App\Models\Profile', 'profile_id');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

}