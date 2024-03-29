<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{

    protected $table = 'brands';
    public $timestamps = true;

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

}