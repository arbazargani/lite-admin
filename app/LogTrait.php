<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

trait LogTrait {
    public function MakeLog($user, $content, $type = 'info')
    {
        $log = new Log();
        $log->user_id = $user;
        $log->content = $content;
        $log->type = $type;
        $log->save();
    }

}
