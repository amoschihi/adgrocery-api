<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $table = 'products';
    public $timestamps = true;


    public static function init(Array $input)
    {
        $product = new Product();

        if (isset($input['price']))
            $product->price = $input['price'];
        if (isset($input['vat']))
            $product->vat = $input['vat'];
        if (isset($input['name']))
            $product->name = $input['name'];
        if (isset($input['description']))
            $product->description = $input['description'];
        if (isset($input['brand_id']))
            $product->brand_id = $input['brand_id'];
        if (isset($input['discount_id']))
            $product->discount_id = $input['discount_id'];
        if (isset($input['category_id']))
            $product->category_id = $input['category_id'];
        if (isset($input['subCategory_id']))
            $product->subCategory_id = $input['subCategory_id'];
        return $product;
    }

    public function init2(Array $input)
    {
        /* foreach ($input as $key => $value) {
             $this->{$key} = $value;
         }*/
        if (isset($input['price']))
            $this->price = $input['price'];
        if (isset($input['vat']))
            $this->vat = $input['vat'];
        if (isset($input['name']))
            $this->name = $input['name'];
        if (isset($input['description']))
            $this->description = $input['description'];
        if (isset($input['brand_id']))
            $this->brand_id = $input['brand_id'];
        if (isset($input['discount_id']))
            $this->discount_id = $input['discount_id'];
        if (isset($input['category_id']))
            $this->category_id = $input['category_id'];
        if (isset($input['subCategory_id']))
            $this->subCategory_id = $input['subCategory_id'];
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function subCategory()
    {
        return $this->belongsTo('App\Models\SubCategory', 'subCategory_id');
    }

    public function orders()
    {
        return $this->belongsToMany('App\models\Order', 'line_orders');
    }

    public function article()
    {
        return $this->hasOne('App\Models\Article');
    }

    public function brand()
    {
        return $this->belongsTo('App\Models\Brand', 'brand_id');
    }

    public function discount()
    {
        return $this->belongsTo('App\Models\Discount', 'discount_id');
    }

    public function profileReview()
    {
        return $this->belongsToMany('App\Models\Profile', 'reviews');
    }

}