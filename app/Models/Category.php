<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $table = 'categories';
    public $timestamps = true;

    public function subCategories()
    {
        return $this->hasMany('App\Models\SubCategory');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

}