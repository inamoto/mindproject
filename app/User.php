<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
//use Carbon\Carbon;

class User extends Authenticatable
{
    //use Notifiable;
     use HasApiTokens, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password',
    ];
    protected $dates = [  // ② 追加
        'confirmed_at',
        'confirmation_sent_at',
    ];
    public function makeConfirmationToken($key) { // ③ 追加
        $this->confirmation_token = hash_hmac(
            'sha256',
            str_random(40).$this->email,
            $key
        );
 
        return $this->confirmation_token;
    }
 
    public function confirm() { // ④ 追加
        $this->confirmed_at = Carbon::now();
        $this->confirmation_token = '';
    }
 
    public function isConfirmed() { // ⑤ 追加
        return ! empty($this->confirmed_at);
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'confirmation_token', 'confirmed_at', 'confirmation_sent_at'
    ];
}
