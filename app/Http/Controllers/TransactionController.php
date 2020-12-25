<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use OneAPI\Laravel\API\Crypto;
use OneAPI\Laravel\API\Currency;
use Carbon\Carbon;

use App\Transaction;
use App\StringTrait;
use App\AlertTrait;
use App\User;
use App\Settings;
use Auth;
use App\Coin;

class TransactionController extends Controller
{
    use StringTrait;
    use AlertTrait;

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

    public function GetDollarPrice() {
        $response = Currency::usd();
        return $response[0]->price;
    }

    public function COIN_TO_USD_old_oneApi($currency) {
        if ($currency == 'bitcoin') {

            $response = Crypto::btc();

        } elseif($currency == 'litecoin') {

            $response = Crypto::ltc();

        } elseif($currency == 'ethereum') {

            $response = Crypto::eth();

        } elseif($currency == 'ethereum-classic') {

            $response = Crypto::eth();

        } else {

            return abort('403', 'ارز موردنظر پشتیبانی نمیشود.');

        }

        return $response->price;
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

        }  elseif ($currency == 'ethereum_classic') {

            $response = (Cache::has("ETCUSDT-usd-price")) ? Cache::get("ETCUSDT-usd-price") : $this->binance('ETCUSDT');
            // $response = $this->binance('ETCUSDT');

        } elseif ($currency == 'zcash') {

            $response = (Cache::has("ZECUSD-usd-price")) ? Cache::get("ZECUSD-usd-price") : $this->binance('ZECUSD');
            // $response = $this->binance('ZECUSD');

        } elseif ($currency == 'tether') {
            $response = (Cache::has("BUSDUSDT-usd-price")) ? Cache::get("BUSDUSDT-usd-price") : $this->binance('BUSDUSDT');
            // $response = $this->binance('BUSDUSDT');

        }  elseif ($currency == 'ravencoin') {
            $response = (Cache::has("RVNUSDT-usd-price")) ? Cache::get("RVNUSDT-usd-price") : $this->binance('RVNUSDT');
            // $response = $this->binance('RVNDUSDT');
            
        } else {

            return abort('403', 'ارز موردنظر پشتیبانی نمیشود.');

        }
        return round(json_decode(json_encode($response->price)));
    }

    public function CalculatePrice($currency, $amount, $usd_price, $output_currency = 'tomans') {
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

    public function MakeTransaction(Request $request, $type = 'buy')
    {
        $min = Coin::whereRaw("lower(name) LIKE '%" . $request['coin'] . "%'")->first()->min_ex_balance;
        $max = Coin::whereRaw("lower(name) LIKE '%" . $request['coin'] . "%'")->first()->max_ex_balance;

        $request->validate([
            'amount' => "required",
            'coin' => 'required'
        ]);

        $settings = [
            'user_authorization_success_message' => Settings::where('name', 'user_authorization_success_message')->first(),
            'user_authorization_failed_message' => Settings::where('name', 'user_authorization_failed_message')->first(),
            'user_authorization_needed_message' => Settings::where('name', 'user_authorization_needed_message')->first(),
            'price_calculation_method' => Settings::where('name', 'price_calculation_method')->first(),
            'dollar_price_sell' => Settings::where('name', 'dollar_price_sell')->first(),
            'public_btc_wallet' => Settings::where('name', 'public_btc_wallet')->first(),
            'public_usdt_wallet' => Settings::where('name', 'public_usdt_wallet')->first(),
        ];

        $transaction = new Transaction();
        $transaction->user_id = Auth::user()->id;
        $transaction->amount = $request['amount'];

        $usd_price = ($settings['price_calculation_method']->value == 'auto') ? $this->GetDollarPrice() : $settings['dollar_price_sell']->value;

        $payable = $this->CalculatePrice($request['coin'], $request['amount'], $usd_price, 'tomans');
        $transaction->payable = $this->NormalizePrice($payable);
        $transaction->description = 'تعداد :' . $request['amount'] . ' | ' . 'ارز موردنظر :' . $request['coin'];
        $transaction->selected_coin = $request['coin'];
        $transaction->save();

        $transaction->hash = sha1($transaction->id);
        $transaction->save();


        $message = 'درخواست شما ثبت شد و از طریق بخش درخواست‌‌های فروش قابل پیگیری است.';
        session(['status' => 'factored', 'message' => $message]);
        return redirect(route('User > Transaction > Show', $transaction->hash));
    }

    public function AddTX(Request $request, $hash)
    {
        $transaction = Transaction::where('hash', $hash)->first();

        if ( is_null($transaction) ) {
            return abort(404);
        }

        if ($request->isMethod('post')) {
            $request->validate([
                'tx_id' => 'required|min:5',
                'transaction_id' => 'required'
            ]);

            if ($request['transaction_id'] != $hash) {
                return abort('403', 'Unauthorized action.');
            }

            $transaction = Transaction::where('hash', $hash)->update([
                'tx_id' => $request['tx_id'],
                'status' => 'waiting'
            ]);
            $this->MakeAlert(User::where('rule', 'admin')->first()->id, 'یک درخواست برای تایید انتقال ارز به شما آماده است. لطفا بررسی نمایید.', 'warning');

            // $transaction = Transaction::findOrFail($id);
            $transaction = Transaction::where('hash', $hash)->first();
            return view('user.transaction.wait', compact('transaction'));

        } elseif ($request->isMethod('get')) {
            $settings = [
                'user_authorization_success_message' => Settings::where('name', 'user_authorization_success_message')->first(),
                'user_authorization_failed_message' => Settings::where('name', 'user_authorization_failed_message')->first(),
                'user_authorization_needed_message' => Settings::where('name', 'user_authorization_needed_message')->first(),
                'price_calculation_method' => Settings::where('name', 'price_calculation_method')->first(),
                'dollar_price' => Settings::where('name', 'dollar_price')->first(),
                'public_btc_wallet' => Settings::where('name', 'public_btc_wallet')->first(),
                'public_usdt_wallet' => Settings::where('name', 'public_usdt_wallet')->first(),
            ];
            // $transaction = Transaction::findOrFail($id);
            $transaction = Transaction::where('hash', $hash)->first();
            return view('user.transaction.addtx', compact(['transaction', 'settings']));
        } else {
            return redirect('/');
        }
    }

    public function ShowTransaction(Request $request, $hash)
    {
        $transaction = Transaction::where('hash', $hash)->first();
        if ( is_null($transaction) ) {
            return abort(404);
        }

        $time = Carbon::parse($transaction->created_at);
        $time->addMinutes(20);

        if ($transaction->status == 'unpaid') {
            return view('user.transaction.show', compact(['transaction']));
        } elseif ($transaction->status == 'waiting') {
            return view('user.transaction.wait', compact(['transaction']));
        } else {
            return view('user.transaction.wait', compact(['transaction']));
        }
    }

    public function Manage() {
        $transactions = User::find(Auth::id())->transaction()->latest()->paginate(10);
        return view('user.transaction.manage', compact(['transactions']));
    }

    Public function RawTx($hash) {
        $transaction = Transaction::where('hash', $hash)->whereNotNull('tx_id')->first();
        
        return (!is_null($transaction) == 1) ? '<html><head><body><pre>'. $transaction->tx_id .'</pre></body></head></html>' : abort('403', 'make screenshot and contact this state to system administrator.');
    }

    public function RawTrackingID($hash) {
        $transaction = Transaction::where('hash', $hash)->whereNotNull('pay_tracking_id')->first();
        
        return (!is_null($transaction) == 1) ? '<html><head><body><pre>'. $transaction->pay_tracking_id .'</pre></body></head></html>' : abort('403', 'make screenshot and contact this state to system administrator.');
    }

    public function Binance($symbol) {
        if (Cache::has("$symbol-usd-price")) {
            return Cache::get("$symbol-usd-price");
        } else {
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

            Cache::put("$symbol-usd-price", $response, now()->addMinutes(1));
            return $response;
        }
    }
}
