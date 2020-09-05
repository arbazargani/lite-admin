<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function receipt()
    {
        return $this->belongsTo('App\Receipt');
    }
}
