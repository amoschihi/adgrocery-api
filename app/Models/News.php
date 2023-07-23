<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{

    protected $table = 'news';
    public $timestamps = true;

    public function image()
    {
        return $this->hasOne('App\Models\Image');
    }
}