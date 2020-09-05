<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Pusher\Pusher;

class ChatController extends Controller
{
    public function triggerChannel(Request $request)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['user-message'])) {
            $options = array(
                'cluster' => 'ap1',
                'useTLS' => true
            );
            $pusher = new Pusher(
                '51256090141dd467b768',
                '120563befa3333df76f9',
                '975289',
                $options
            );

            $data['message'] = $request['user-message'];
            $data['id'] = Auth::user()->id;
            $data['date'] = date("H:i");
            $data['name'] = Auth::user()->name;
            $pusher->trigger('my-channel', 'my-event', $data);
        }
    }
}
