<?php

namespace App\Http\Controllers;

use App\Alert;
use Illuminate\Http\Request;

class AlertController extends Controller
{
    public function SetAsRead($id) {
        $alert = Alert::findOrFail($id)->update([
           'read' => 1,
        ]);
        return back();
    }
}
