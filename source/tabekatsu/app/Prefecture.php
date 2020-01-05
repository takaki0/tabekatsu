<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prefecture extends Model
{
    protected $guarded = ['id'];

    public static $rules = [];

    public function members(){
        return $this->hasMany('App\Member', 'prefecture', 'id');
    }

}
