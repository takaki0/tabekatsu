<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Token extends Model
{

    protected $guarded = ['id'];

    public static $rules = [];

    /** relations start **/
    public function member(){
        return $this->belongsTo('App\Member', 'login_id', 'login_id');
    }
    /** relations end **/

    /**
     * genarate random string with 128 ascii characters.
     *
     * @param :
     * @return string :
     * @throws
     */
    public static function get_csrf_token(): string {
        $TOKEN_LENGTH = 128;
        $str1 = str_replace(".", "", uniqid( bin2hex(random_bytes(5)) , true));
        $str2 = str_replace(".", "", uniqid( bin2hex(random_bytes(5)) , true));
        $str3 = str_replace(".", "", uniqid( bin2hex(random_bytes(5)) , true));
        $str4 = str_replace(".", "", uniqid( bin2hex(random_bytes(5)) , true));
        return join("", [$str1, $str2, $str3, $str4]);
    }

}
