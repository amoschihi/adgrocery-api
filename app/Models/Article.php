<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    protected $table = 'articles';
    public $timestamps = true;

    public static function init(Array $input)
    {
        $article = new Article();
        if (isset($input['size']))
            $article->size = $input['size'];
        if (isset($input['stock']))
            $article->stock = $input['stock'];
        return $article;
    }

    public function init2(Array $input)
    {
        if (isset($input['size']))
            $this->size = $input['size'];
        if (isset($input['stock']))
            $this->stock = $input['stock'];

    }

    public function images()
    {
        return $this->hasMany('App\Models\Image');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

    public function colors()
    {
        return $this->belongsToMany('App\Models\Color', 'color_articles');
    }

    public function materials()
    {
        return $this->belongsToMany('App\Models\Material', 'material_articles');
    }
}