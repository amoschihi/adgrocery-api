<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    protected $table = 'profiles';
    public $timestamps = true;

    public function addresses()
    {
        return $this->hasMany('App\Models\Address');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function productsWishlist()
    {
        return $this->belongsToMany('App\models\Product', 'wishlists');
    }

    public function productsCompare()
    {
        return $this->belongsToMany('App\Models\Product', 'compares');
    }

    public function line_orders()
    {
        return  $this->hasMany('App\Models\LineOrder');
    }


}