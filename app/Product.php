<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $table="products";
    protected $guarded = [];

    protected $hidden = [];

    public function menus()
    {
        return $this->belongsTo('App\Menu');
    }
    public function productPhotos()
    {
        return $this->hasMany('App\ProductPhoto');
    }
}
