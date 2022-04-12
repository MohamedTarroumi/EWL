<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
        protected $attributes = ['name'];

    //
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_brand', 'category_id', 'brand_id');
    }

    public function models()
    {
        return $this->hasMany('App\PModel');
    }

    public function products ()
    {
        return $this->hasMany('App\Product');
    }
}
