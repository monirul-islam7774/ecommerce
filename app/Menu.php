<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    public $table="menus";
    protected $guarded = [];

    protected $hidden = [];

    public function products()
    {
        return $this->hasMany('App\Product');
    }
}
