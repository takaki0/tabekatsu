<?php

namespace App;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $guarded = ['id'];

    public static $rules = [];

    public function send_member(){
        return $this->belongsTo('App\Member', 'sender_id', 'id');
    }

    public function received_member(){
        return $this->belongsTo('App\Member', 'recipient_id', 'id');
    }

    public function scopeOwnMessages($query, $own_id){
        return $query->where('sender_id', $own_id)
            ->orWhere('recipient_id', $own_id);
    }
    //usage: Message::ownMessages($member_id)->with('send_members')->with('rececived_members')->orderby('id');

    /**
     * Get which $own_id is sender or recipient .
     *
     * @param int $own_id:
     * @return int :1.sender, 2:recipient, 0:neither
     * @throw
     */
    public function getOwnPosition(int $own_id): int {
        if($this->sender_id == $own_id){
            return 1;
        }elseif ($this->recipient_id == $own_id){
            return 2;
        }else{
            return 0;
        }
    }

    /**
     * Get another related member information.
     *
     * @param int $own_id:
     * @return Member :
     * @throw
     */
    public function getCounterMember(int $own_id): ?Member{
        if($this->sender_id == $own_id){
            return $this->received_member;
        }elseif ($this->recipient_id == $own_id){
            return $this->send_member;
        }else{
            return null;
        }
    }

}
