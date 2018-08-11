<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{
    public $table="productphotos";
    protected $guarded = [];

    protected $hidden = [];

    public function products()
    {
        return $this->belongsTo('App\Product');
    }
}
