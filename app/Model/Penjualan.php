<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    public $guarded = [];
    public function user()
    {
        return $this->hasOne('App\User',  'id', 'id_kasir');
    }
}
