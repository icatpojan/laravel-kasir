<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];
    public function product()
    {
        return $this->belongsTo('App\Product', 'id','category_id');
    }
}
