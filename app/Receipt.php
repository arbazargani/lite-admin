<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $guarded = ['admin_action'];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function payment()
    {
        return $this->hasOne('App\Payment');
    }
}
