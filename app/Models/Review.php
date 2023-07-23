<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    protected $table = 'reviews';
    public $timestamps = true;

    public function profile()
    {
        return $this->belongsTo('App\Models\Profile');
    }

    public function products()
    {
        return $this->belongsTo('App\Models\Product');
    }

}