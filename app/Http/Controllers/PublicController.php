<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OneAPI\Laravel\API\Crypto;
use OneAPI\Laravel\API\Currency;

class PublicController extends Controller
{
    public function Index() {
        return view('public.home.index');
    }
}
