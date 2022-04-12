<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table='categories';

    protected $attributes = ['name'];

    //
    public function brands()
    {
        return $this->belongsToMany('App\Brand','category_brand', 'category_id', 'brand_id');
    }

    public function products ()
    {
        return $this->hasMany('App\Product');
    }

}
