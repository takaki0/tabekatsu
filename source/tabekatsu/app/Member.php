<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $guarded = ['id'];

    public static $rules = [
        'login_id' => 'required|alpah_dash',
        'mail_address' => 'required|email',
        'age' => 'required|integer|min:8|max:150',
        'sex' => 'required|in:1,2',
        'area' => 'required',
        'prefecture' => 'required',
        'join_date' => 'date',
    ];

    /** relations start **/
    public function token(){
        return $this->hasOne('App\Token', 'login_id', 'login_id');
    }

    public function area(){
        return $this->belongsTo('App\Area', 'area', 'id');
    }

    public function prefecture(){
        return $this->belongsTo('App\Prefecture', 'prefecture', 'id');
    }

    public function send_messages(){
        return $this->hasMany('App\Message', 'sender_id', 'id');
    }

    public function received_messages(){
        return $this->hasMany('App\Message', 'recipient_id', 'id');
    }

    public function send_datings(){
        return $this->hasMany('App\Dating', 'sender_id', 'id');
    }

    public function received_datings(){
        return $this->hasMany('App\Dating', 'recipient_id', 'id');
    }
    /** relations end **/

    /**
     * set a hashed_password from a posted raw password.
     * the password must be validated before you use this function.
     *
     * @param string $password:
     * @return bool: true=succeeded, false=failed
     * @throws
     */
    public function set_hashed_password(string $password): bool {
        if(!$password){
            return false;
        }
        $this->hashed_password = password_hash($password, PASSWORD_DEFAULT);
        return true;
    }

    /**
     * set a hashed_password from a posted raw password.
     * the password must be validated before you use this function.
     *
     * @param
     * @return bool: true=succeeded, false=failed
     * @throws
     */
    public function set_login_id(): bool {
        if(!$this->mail_address){
            return false;
        }
        $this->login_id = $this->mail_address;
        return true;
    }

    /**
     * generate a new token for $login_id, and save it with expiration-time.
     *
     * @param string $login_id:
     * @return Token :
     * @throws
     */
    public static function generate_token(string $login_id): ?Token {
        $EXPIRES_SECONDS = 3600;
        $token = Token::where('login_id', $login_id)->first();
        if(!$token){
            $token = new Token(['login_id' => $login_id]);
        }
        $token->fill([
            'token' => Token::get_csrf_token(),
            'refresh_token' => Token::get_csrf_token(),
            'start_datetime' => new Carbon(),
            'expires' => $EXPIRES_SECONDS,
        ])->save();
        return $token;
    }

    /**
     * regenerate a new token for $login_id, and save it with expiration-time.
     *
     * @param string $refresh_token:
     * @return Token :
     * @throws
     */
    public static function refresh_token(string $refresh_token): ?Token {
        $EXPIRES_SECONDS = 3600;
        $token = Token::where('refresh_token', $refresh_token)->first();
        if(!$token){
            return null;
        }
        $token->fill([
            'token' => Token::get_csrf_token(),
            'refresh_token' => Token::get_csrf_token(),
            'start_datetime' => new Carbon(),
            'expires' => $EXPIRES_SECONDS,
        ])->save();
        return $token;
    }

    /**
     * delete the token for $login_id
     *
     * @param string $login_id:
     * @return bool :
     * @throws
     */
    public function delete_token(string $login_id): bool {
        $token = Token::where('login_id', $login_id)->first();
        if($token){
            $token->delete();
        }
    }

    /**
     * verify the $token.
     *
     * @param string $token:
     * @return Member :
     * @throws
     */
    public function verify_token(string $token): Member {
        $token = Token::where('token', $token)->first();
        if(!$token){
            return null;
        }
        $member = Member::where('user_id', $token->user_id)->first();
        return $member;

    }

}
