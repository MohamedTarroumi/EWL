<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'id';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const CREATED_BY = 'created_by';
    const UPDATED_BY = 'updated_by';

  protected $attributes = ['feautres_file' => "FFFFFF"];
    
    
    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function model()
    {
        return $this->belongsTo('App\Pmodel');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');

    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }

    public function files()
    {
        return $this->hasMany('App\Attachement','article_id');
    }


}
