<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OneAPI\Laravel\API\Crypto;
use OneAPI\Laravel\API\Currency;
use Illuminate\Support\Facades\Redis;
use Carbon\Carbon;
use Melipayamak\MelipayamakApi;
use Illuminate\Support\Facades\Hash;

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
use Session;

class PublicController extends Controller
{
    public function Index() {
        $settings = Settings::all();
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
            'to' => '09353299729',
            'text' =>  "Silence is golden.\nbelieve or not.",
        ];
        // return "job will not dispatch, casue of developers stuffs!";
        SendSms::dispatch($information)->delay(now()->addMinutes(0));
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

    public function Session(Request $request) {
        // return dd($request->session());
        // $session_id = new Session;
        // $session_id = $request->session()->all();
        // $methods = get_class_methods($session_id);
        // foreach ($methods as $method_name) {
        //     echo "$method_name<hr/>";
        // }
        // $session_info = Redis::keys("*$session_id");
        // $info = Redis::get($session_info[0]);
        // return $session_id;
        
        $session_id = Session::getId();
        // Redis::set('key2', 'val2');
        // echo Redis::get('key2');
        $key = Redis::keys("*$session_id")[0];
        $session_value = Redis::get(str_replace(strtolower(env('APP_NAME')).'_database_', '', $key));

        echo (isset($_COOKIE[strtolower(env('APP_NAME'))."_session"]) == $session_id) ? 'authenticated.' : 'unathorized session.';        
    }

    public function blockChairValidator($chain, $hash, $is_erc = 0) {
        
        /*** curl get  start ***/
        $url = "https://api.blockchair.com/$chain/dashboards/transaction/$hash";
        if ($is_erc) {
            $url .= "?erc_20=true";
        }
        
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
        //for debug only!
        /*
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        */
        $res = curl_exec($curl);
        // header('Content-Type: application/json');
        $response = json_decode($res, true);

        curl_close($curl);
        
        echo "url is : $url <hr/><pre>";
        if ($chain == 'bitcoin') {

            if ($response['data']["$hash"]['transaction']['block_id'] != -1) {
                $block_id = (int) $response['data']["$hash"]['transaction']['block_id'];
                $state = (int) $response['context']['state'];
                $confirms = $state-$block_id+1;
    
                echo "Confirmed [". $confirms . "].";
            } else {
                echo "Not confirmed.";
            }

        } elseif ($chain == 'ethereum') {

            if ($response['data']["$hash"]['transaction']['block_id'] != -1) {
                $block_id = (int) $response['data']["$hash"]['transaction']['block_id'];
                $state = (int) $response['context']['state'];
                $confirms = $state-$block_id+1;
    
                echo "Confirmed [". $confirms . "].";
            } else {
                echo "Not confirmed.";
            }

        } else {
            echo "Unsupported chain.";
        }
        
    }

}