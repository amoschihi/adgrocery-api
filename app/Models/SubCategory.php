<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{

    protected $table = 'subCategories';
    public $timestamps = true;

    public function categories()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Product');
    }

}