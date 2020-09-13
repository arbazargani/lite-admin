<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

trait AlertTrait {
    public function MakeAlert($user, $content, $type = 'info', $broadcast = false)
    {
        $alert = new Alert();
        $alert->user_id = $user;
        $alert->content = $content;
        $alert->type = $type;
        $alert->save();
    }

}
