<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    public function category()
    {
        return $this->hasOne('App\Model\Category',  'id', 'category_id');
    }
}
