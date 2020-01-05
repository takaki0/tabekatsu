<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dating extends Model
{

    protected $guarded = ['id'];

    public static $rules = [];

    public function send_member(){
        return $this->belongsTo('App\Member', 'sender_id', 'id');
    }

    public function received_member(){
        return $this->belongsTo('App\Member', 'recipient_id', 'id');
    }

}
