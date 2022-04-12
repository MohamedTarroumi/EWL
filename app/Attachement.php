<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachement extends Model
{
    //
    protected $table ="files";
    protected $fillable  = ['name','type','path','status','created_by','created_at'];

   
    public function products ()
    {
        return $this->belongsTo('App\Product','article_id');
    }
}
