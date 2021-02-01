<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Thread;
use Auth;

class ThreadController extends Controller
{
    public function Index() {
        return view('');
    }

    public function MakeThread() {
        $thread = new Thread();
        $thread->user_id = Auth::user()->id;
        $thread->parent = 0;
        $thread->status = 'open';
        $thread->importance = 'low';
        $thread->content = 'this is a fucking sample content';
        $thread->attachments = json_encode([
            'file_001.jpg',
            'file_002.jpg'
        ]);
        $thread->hash = sha1($thread->id);
        $thread->save();
    }
}
