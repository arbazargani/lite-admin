<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function receipt()
    {
        return $this->hasMany('App\Receipt');
    }

    public function payment()
    {
        return $this->hasOneThrough('App\Payment', 'App\Receipt');
    }

    public function alert()
    {
        return $this->hasMany('App\Alert');
    }

    public function transaction()
    {
        return $this->hasMany('App\Transaction');
    }

    public function exchange()
    {
        return $this->hasMany('App\Exchange');
    }

    public function loginSecurity()
    {
        return $this->hasOne('App\LoginSecurity');
    }
}
