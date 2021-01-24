<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OneAPI\Laravel\API\Crypto;
use OneAPI\Laravel\API\Currency;
use Illuminate\Support\Facades\Redis;
use Carbon\Carbon;
use Melipayamak\MelipayamakApi;

use Illuminate\Support\Facades\Mail;

use App\Mail\ReceiptCreation;
use App\Mail\ReceiptPaid;

use App\Jobs\SendReceiptCreationMail;
use App\Jobs\SendReceiptPaidMail;
use App\Jobs\SendSms;

use App\Settings;
use App\Coin;
use App\User;
use App\Receipt;

use Auth;

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

        $receipt = Receipt::findOrFail(10);
        // return $receipt;
        $user = User::findOrFail($receipt->user_id);
        // return $user;

        $emailJob = (new  SendReceiptPaidMail($receipt, $user));
        dispatch($emailJob);
    }

    public function Test() {
        $receipts = Receipt::where('status', '!=', 'unpaid')->first();
        $user = Auth::User();
        return $receipts->user->name;

    }

    public function Sms() {
        $information = [
            'to' => ['09308990856', '09356252177'],
            'text' =>  "cfx63"." <br/> "."cfx64",
        ];
        return "job will not dispatch, casue of developers stuffs!";
        // SendSms::dispatch($information)->delay(now()->addMinutes(0));
    }

    public function phpredis1() {
        Redis::pipeline(function ($pipe) {
            for ($i = 0; $i < 1000; $i++) {
                $pipe->set("key:$i", $i);
            }
        });
    }

    public function phpredis2() {
        $values = Redis::keys("*");
        return $values;
    }
}