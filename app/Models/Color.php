<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{

    protected $table = 'colors';
    public $timestamps = true;

    public function articles()
    {
        return $this->belongsToMany('App\Models\Article', 'color_articles');
    }

}