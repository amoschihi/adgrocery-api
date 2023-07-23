<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    protected $table = 'images';
    public $timestamps = true;

    public function articles()
    {
        return $this->belongsTo('App\Models\Article', 'article_id');
    }

    public function news()
    {
        return $this->belongsTo('App\Models\News', 'news_id');
    }
}