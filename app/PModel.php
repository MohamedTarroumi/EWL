<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PModel extends Model
{
    //
    protected $table ="models";
    protected $attributes = ['name','brand_id','category_id'];

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }

    public function products ()
    {
        return $this->hasMany('App\Product');
    }
}
