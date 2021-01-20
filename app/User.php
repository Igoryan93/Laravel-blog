<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    protected $fillable = [
//        'name', 'email', 'password',
//    ];

      protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function info() {
        return $this->hasOne('App\Info');
    }

    public static function is_admin() {
        return Auth::user()->is_admin ===1 ? true : false ;
    }

    public static function register($data) {
        $user = new self;

        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->is_admin = $data['is_admin'];
        $user->token = $data['token'];
        $user->token_date = $data['token_date'];
        $user->verify = $data['verify'];
        $user->save();
    }
}
