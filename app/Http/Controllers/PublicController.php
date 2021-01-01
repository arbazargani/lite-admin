<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OneAPI\Laravel\API\Crypto;
use OneAPI\Laravel\API\Currency;
use Illuminate\Support\Facades\Redis;

use Illuminate\Support\Facades\Mail;
use App\Mail\IdentityConfirmation;

use App\Settings;
use App\Coin;
use App\User;

class PublicController extends Controller
{
    public function Index() {
        $settings = [
            'price_calculation_method' => Settings::where('name', 'price_calculation_method')->first(),
            'dollar_price_buy' => Settings::where('name', 'dollar_price_buy')->first(),
            'dollar_price_sell' => Settings::where('name', 'dollar_price_sell')->first(),
            'application_index_meta_title' => Settings::where('name', 'application_index_meta_title')->first(),
            'application_index_meta_description' => Settings::where('name', 'application_index_meta_description')->first(),
            'application_index_meta_keyword' => Settings::where('name', 'application_index_meta_keyword')->first(),
            'application_index_meta_robots' => Settings::where('name', 'application_index_meta_robots')->first(),
        ];

        $coins_usd = Coin::select(['name', 'usd_price'])->get();
        $coins = Coin::all();

        return view('public.home.index', compact(['settings', 'coins_usd', 'coins']));
    }

    public function Redis() {
        $handler = app()->make('redis');

        for ($i = 0; $i < 20000000; $i++) {
            $handler->set('key_'.$i, 'val_'.$i);
        }
        return 'job done.';
    }

    public function RedisReader() {
        $handler = app()->make('redis');
        for ($i = 0; $i < 1001; $i++) {
            $res = $handler->get('key_'.$i);
            echo "$res<br/>";
        }
        return;
    }

    Public function Mail() {
        // $user = User::findOrFail(1);
        // return view('emails.ReceiptCreation', compact('user'));
        // $user = User::findOrFail(1);
        // Mail::to($user->email)->send(new IdentityConfirmation($user));
    }
}
