<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

use Auth;
use App\User;
use App\Receipt;
use App\StringTrait;
use App\Settings;
use App\Coin;

class ReceiptController extends Controller
{
    use StringTrait;

    public function CalculatePrice_old($currency, $amount)
    {
        if (env('API_DOWN')) {
            $array = array('ok' => false,
                'error' => 'System under maintenance.'
            );
            return json_encode($array);
        }
        $in = $currency;
        $to = 'IRT';
        $number = $amount;

        /*** curl get  start ***/
        $ch = curl_init();
        curl_setopt_array($ch,
            [
                CURLOPT_URL => 'https://arzdigital.com/coins/calculator/?convert=' . $number . '-' . $in . '-to-' . $to . '',
                CURLOPT_POST => true,
                //CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_RETURNTRANSFER => true
            ]
        );
        $End = curl_exec($ch);
        /*** curl get End ***/

        /****  price number to digital start ****/
        preg_match_all('#<input disabled type="text" value="(.*?)" inputmode="numeric" pattern="(.*?)">#', $End, $numeric);
        $price_to_digital = $numeric[1][0];
        /****  price number to digital End ****/

        /****  price number to dollar start ****/
        $style = "class='price'";
        preg_match_all('#<span ' . $style . ' data-dollari="(.*?)" eq_toman="(.*?)">(.*?)</span>#', $End, $dollar);
        $price_to_dollar = $dollar[3][0];
        /****  price number to dollar End ****/

        /****  price number to tomans start ****/
        preg_match_all('#<h4 class="xtomans">(.*?)<span class="(.*?)">(.*?)</span>(.*?)</h4>#', $End, $tomans);
        $price_to_tomans = $tomans[3][0];
        /****  price number to tomans End ****/


        if (($in && $to && $number) == true) {
            if (($price_to_digital && $price_to_dollar && $price_to_tomans) == true) {
                $array = array('ok' => true,
                    'in' => $in,
                    'to' => $to,
                    'number' => $number,
                    'price_to_digital' => $price_to_digital,
                    'price_to_dollar' => $price_to_dollar,
                    'price_to_tomans' => $price_to_tomans
                );
                return json_encode($array);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function GetDollarPrice($key = "920449d00b2704b58dc040544e1f79a6") {
        $ch = curl_init("https://oneapi.ir/api/currency/usd");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("OneAPI-Key: $key"));
        
        $response = curl_exec($ch);
        $response = json_decode($response);
        
        curl_close($ch);

        return $response[0]->price;
    }

    public function COIN_TO_USD_OLD_oneApi($currency, $key = "e9375f00b2d1ab8944cb9c64b6482b75") {
        $ch = curl_init("https://oneapi.ir/api/crypto/$currency");

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("OneAPI-Key: $key"));
        
        $response = curl_exec($ch);
        $response = json_decode($response);
        
        curl_close($ch);

        // return ($node != false) ? $response[0]->$node : $response;
        return $response->price;
    }

    public function COIN_TO_USD_old($currency) {
        if ($currency == 'bitcoin') {

            $response = $this->binance('BTCUSDT');

        } elseif($currency == 'litecoin') {

            $response = $this->binance('LTCUSDT');

        } elseif($currency == 'ethereum') {

            $response = $this->binance('ETHUSDT');

        } else {

            return abort('403', 'ارز موردنظر پشتیبانی نمیشود.');

        }
        return round(json_decode(json_encode($response->price)));
    }

    public function COIN_TO_USD($currency) {
        $currency = strtolower($currency);
        if ($currency == 'bitcoin') {

            $response = (Cache::has("BTCUSDT-usd-price")) ? Cache::get("BTCUSDT-usd-price") : $this->binance('BTCUSDT');
            // $response = $this->binance('BTCUSDT');

        } elseif ($currency == 'litecoin') {

            $response = (Cache::has("LTCUSDT-usd-price")) ? Cache::get("LTCUSDT-usd-price") : $this->binance('LTCUSDT');
            // $response = $this->binance('LTCUSDT');

        } elseif ($currency == 'ethereum') {

            $response = (Cache::has("ETHUSDT-usd-price")) ? Cache::get("ETHUSDT-usd-price") : $this->binance('ETHUSDT');
            // $response = $this->binance('ETHUSDT');

        } elseif ($currency == 'ethereum-classic') {

            $response = (Cache::has("ETCUSDT-usd-price")) ? Cache::get("ETCUSDT-usd-price") : $this->binance('ETCUSDT');
            // $response = $this->binance('ETCUSDT');

        }  elseif ($currency == 'ravencoin') {
            $response = (Cache::has("RVNDUSDT-usd-price")) ? Cache::get("RVNDUSDT-usd-price") : $this->binance('RVNDUSDT');
            // $response = $this->binance('RVNDUSDT');
            
        } elseif ($currency == 'zecash') {

            $response = (Cache::has("ZECUSDT-usd-price")) ? Cache::get("ZECUSDT-usd-price") : $this->binance('ZECUSDT');
            // $response = $this->binance('ZECUSD');

        } elseif ($currency == 'tether') {
            $response = (Cache::has("BUSDUSDT-usd-price")) ? Cache::get("BUSDUSDT-usd-price") : $this->binance('BUSDUSDT');
            // $response = $this->binance('BUSDUSDT');

        } else {

            return abort('403', 'ارز موردنظر پشتیبانی نمیشود.');

        }
        return round(json_decode(json_encode($response->price)));
    }

    public function CalculatePrice($currency, $amount, $output_currency = 'tomans', $usd_price) {
        $TO_USD = $this->COIN_TO_USD($currency);
        $price = $amount * $TO_USD;
        if ($output_currency == 'tomans') {

            return $price * $usd_price;

        } elseif ($output_currency == 'dollar') {

            return $price;

        } else {
            return abort('403', 'Bad Request.');
        }
    }

    public function MakeReceipt(Request $request)
    {
        $request->validate([
            'coin' => 'required'
        ]);

        $min = Coin::whereRaw("lower(name) LIKE '%" . $request['coin'] . "%'")->first()->min_ex_balance;
        $max = Coin::whereRaw("lower(name) LIKE '%" . $request['coin'] . "%'")->first()->max_ex_balance;

        $request->validate([
            'wallet' => 'required|min:5',
            // 'amount' => "numeric|required|min:$min|max:$max",
            'amount' => "numeric|required",
        ]);

        $settings = [
            'user_authorization_success_message' => Settings::where('name', 'user_authorization_success_message')->first(),
            'user_authorization_failed_message' => Settings::where('name', 'user_authorization_failed_message')->first(),
            'user_authorization_needed_message' => Settings::where('name', 'user_authorization_needed_message')->first(),
            'price_calculation_method' => Settings::where('name', 'price_calculation_method')->first(),
            'dollar_price_buy' => Settings::where('name', 'dollar_price_buy')->first(),
            'public_btc_wallet' => Settings::where('name', 'public_btc_wallet')->first(),
            'public_usdt_wallet' => Settings::where('name', 'public_usdt_wallet')->first(),
        ];

        $receipt = new Receipt();
        $receipt->user_id = Auth::user()->id;
        $receipt->amount = $request['amount'];
        $receipt->wallet = $request['wallet'];


        $usd_price = ($settings['price_calculation_method']->value == 'auto') ? $this->GetDollarPrice() : $settings['dollar_price_buy']->value;

        $payable = $this->CalculatePrice($request['coin'], $request['amount'], 'tomans', $usd_price);
        $receipt->payable = $this->NormalizePrice($payable);
        $receipt->description = 'تعداد :' . $request['amount'] . ' | ' . 'ارز موردنظر :' . $request['coin'];
        $receipt->selected_coin = $request['coin'];
        $receipt->save();

        $receipt->hash = sha1($receipt->id);
        $receipt->save();

        $message = 'درخواست شما ثبت شد و از طریق بخش فاکتورها قابل پیگیری است.';
        session(['status' => 'factored', 'message' => $message]);
        return redirect(route('User > Receipt > Show', $receipt->hash));
    }

    public function Manage() {
        $receipts = User::find(Auth::id())->receipt()->latest()->paginate(10);
        return view('user.receipt.manage', compact(['receipts']));
    }

    public function ShowReceipt(Request $request, $hash)
    {
        // $receipt = Receipt::findOrFail($id);
        // return view('user.receipt.show', compact(['receipt']));
        $receipt = Receipt::where('hash', $hash)->first();
        if ( is_null($receipt) ) {
            return abort(404);
        }

        return view('user.receipt.show', compact(['receipt']));
    }

    public function Binance($symbol) {
        /*** curl get  start ***/
        $url = "http://api.arbazargani.ir/?symbol=$symbol";
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    
        //for debug only!
        /*
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        */
    
        $res = curl_exec($curl);
        $response = json_decode($res);
        // header('Content-Type: application/json');
        curl_close($curl);
        // echo json_encode($response);
        return $response;
    }
}