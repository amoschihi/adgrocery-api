<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{

    protected $table = 'materials';
    public $timestamps = true;

    public function articles()
    {
        return $this->belongsToMany('App\Models\Article', 'material_articles');
    }

}