<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    //
    public function addresses()
    {
        return $this->hasMany('App\Models\Address');
    }
}
