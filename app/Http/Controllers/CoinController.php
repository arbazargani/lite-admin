<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use OneAPI\Laravel\API\Crypto;
use OneAPI\Laravel\API\Currency;

use Exception;
use Binance\API;
use Carbon\Carbon;
use App\StringTrait;
use App\Settings;
use App\Coin;

class CoinController extends Controller
{
    use StringTrait;

    public function AddCoin()
    {
        return view('admin.dashboard.coin.index');
    }

    public function UpdateCoin(Request $request, $id)
    {

    }

    public function GetDollarPrice()
    {
        $response = Currency::usd();
        return $response[0]->price;
    }

    public function COIN_TO_USD_old_oneApi($currency)
    {
        if ($currency == 'bitcoin') {

            $response = Crypto::btc();

        } elseif ($currency == 'litecoin') {

            $response = Crypto::ltc();

        } elseif ($currency == 'ethereum') {

            $response = Crypto::eth();

        } else {

            return abort('403', 'ارز موردنظر پشتیبانی نمیشود.');

        }

        return $response->price;
    }

    public function COIN_TO_USD($currency)
    {
        $response = (Cache::has("$currency-usd-price")) ? Cache::get("$currency-usd-price") : $this->binance($currency);

        /*
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

        }  elseif ($currency == 'ravencoin') {
            $response = (Cache::has("RVNUSDT-usd-price")) ? Cache::get("RVNUSDT-usd-price") : $this->binance('RVNUSDT');
            // $response = $this->binance('RVNUSDT');

        } elseif ($currency == 'zecash') {

            $response = (Cache::has("ZECUSDT-usd-price")) ? Cache::get("ZECUSDT-usd-price") : $this->binance('ZECUSDT');
            // $response = $this->binance('ZECUSD');

        } elseif ($currency == 'tether') {
            $response = (Cache::has("BUSDUSDT-usd-price")) ? Cache::get("BUSDUSDT-usd-price") : $this->binance('BUSDUSDT');
            // $response = $this->binance('BUSDUSDT');

        } elseif ($currency == 'tron') {
            $response = (Cache::has("TRXUSDT-usd-price")) ? Cache::get("TRXUSDT-usd-price") : $this->binance('TRXUSDT');
            // $response = $this->binance('TRXUSDT');

        } elseif ($currency == 'ripple') {
            $response = (Cache::has("XRPUSDT-usd-price")) ? Cache::get("XRPUSDT-usd-price") : $this->binance('XRPUSDT');
            // $response = $this->binance('XRPUSDT');

        } else {

            return abort('403', 'ارز موردنظر پشتیبانی نمیشود.');

        }
        */
        // return (json_decode(json_encode($response->price)) < 0) ? json_decode(json_encode($response->price)) : round(json_decode(json_encode($response->price)));
        return (json_decode(json_encode($response->price)));
    }

    public function CalculatePrice($currency, $amount, $usd_price, $output_currency = 'tomans')
    {
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

    public function ExchangeSell(Request $request)
    {
        if (env('API_DOWN')) {
            $array = array('ok' => false,
                'error' => 'System under maintenance.'
            );
            return json_encode($array);
        }
        if ($request->isMethod('get')) {

            $in = ($request['currency-in']) ? $request['currency-in'] : false;
            $number = ($request['amount']) ? $request['amount'] : false;

            if ($in === false || $number === false) {
                $array = array('ok' => false,
                    'error' => 'required params not received.'
                );
                return json_encode($array);
            }
            $settings = [
                'price_calculation_method' => Settings::where('name', 'price_calculation_method')->first(),
                'dollar_price_buy' => Settings::where('name', 'dollar_price_buy')->first(),
                'dollar_price_sell' => Settings::where('name', 'dollar_price_sell')->first(),
                'dollar_price_buy_tolerance' => Settings::where('name', 'dollar_price_buy_tolerance')->first(),
                'dollar_price_sell_tolerance' => Settings::where('name', 'dollar_price_sell_tolerance')->first(),
            ];

            // $usd_price = ($settings['price_calculation_method']->value == 'auto') ? $this->GetDollarPrice() : $settings['dollar_price_sell']->value;;
            // $usd_price = ($settings['price_calculation_method']->value == 'auto') ? $this->Nobitex()-$settings['dollar_price_sell_tolerance']->value : $settings['dollar_price_sell']->value;;
            $usd_price = ($settings['price_calculation_method']->value == 'auto') ? $this->AbanTether() - $settings['dollar_price_sell_tolerance']->value : $settings['dollar_price_sell']->value;

            $array = array('ok' => true,
                'dollars' => number_format(ceil($this->COIN_TO_USD($request['currency-in']))),
                'tomans' => number_format(ceil($this->CalculatePrice($request['currency-in'], $request['amount'], $usd_price, 'tomans'))),
            );
            return json_encode($array);
        }
    }

    public function ExchangeBuy(Request $request)
    {
        if (env('API_DOWN')) {
            $array = array('ok' => false,
                'error' => 'System under maintenance.'
            );
            return json_encode($array);
        }
        if ($request->isMethod('get')) {

            $in = ($request['currency-in']) ? $request['currency-in'] : false;
            $number = ($request['amount']) ? $request['amount'] : false;

            if ($in === false || $number === false) {
                $array = array('ok' => false,
                    'error' => 'required params not received.'
                );
                return json_encode($array);
            }
            $settings = [
                'price_calculation_method' => Settings::where('name', 'price_calculation_method')->first(),
                'dollar_price_buy' => Settings::where('name', 'dollar_price_buy')->first(),
                'dollar_price_sell' => Settings::where('name', 'dollar_price_sell')->first(),
                'dollar_price_buy_tolerance' => Settings::where('name', 'dollar_price_buy_tolerance')->first(),
                'dollar_price_sell_tolerance' => Settings::where('name', 'dollar_price_sell_tolerance')->first(),
            ];

            // $usd_price = ($settings['price_calculation_method']->value == 'auto') ? $this->GetDollarPrice() : $settings['dollar_price_buy']->value;
            // $usd_price = ($settings['price_calculation_method']->value == 'auto') ? $this->Nobitex()+$settings['dollar_price_buy_tolerance']->value : $settings['dollar_price_buy']->value;
            $usd_price = ($settings['price_calculation_method']->value == 'auto') ? $this->AbanTether() + $settings['dollar_price_buy_tolerance']->value : $settings['dollar_price_buy']->value;
            $array = array('ok' => true,
                'dollars' => number_format(ceil($this->COIN_TO_USD($request['currency-in']))),
                'tomans' => number_format(ceil($this->CalculatePrice($request['currency-in'], $request['amount'], $usd_price, 'tomans'))),
            );
            return json_encode($array);
        }
    }

    public function Binance_v1()
    {
        $endpoint = 'https://api.binance.com/api/v3/ticker/price?symbol=LTCBTC&timestamp=' . Carbon::now()->toDateTimeString();
        try {
            $curl = curl_init();
            if (FALSE === $curl)
                throw new Exception('Failed to initialize request.');

            curl_setopt_array($curl, array(
                CURLOPT_URL => $endpoint,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 60,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                // CURLOPT_HTTPHEADER => $httpheader,
            ));

            $response = curl_exec($curl);

            if (FALSE === $response)
                throw new Exception(curl_error($curl), curl_errno($curl));

            $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            if (200 != $http_status)
                throw new Exception($response, $http_status);

            curl_close($curl);
        } catch (Exception $e) {
            $response = $e->getCode() . $e->getMessage();
            echo $response;
        }
        return $response;
    }

    public function Binance_v2()
    {
        $url = $endpoint = 'https://api.binance.com/api/v1/ticker/price?symbol=LTCBTC';


        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array("OneAPI-Key: $key"));
        $response = curl_exec($ch);

        $json = json_decode($response);

        return var_dump($json);
    }

    public function Binance_v3()
    {
        $key = "ThzJPQ6k32JEQQtvtAmt4gMqcbELDdRqPl9RG5NnIur27zCdKIk7AA3Mf6sEEao2";
        $secret = "vEKoKnJ5QeT99mgjcsqyABsvBfsTe6PsKGGEz5UasWedWE7HZ7NmnX6htiMNhTen";
        $api = new \Binance\API($key, $secret);

        $price = $api->price("BNBBTC");
        return $price;
    }

    public function Binance_v4()
    {
        $endpoint = 'https://api.binance.com/api/v3/time';
        $endpoint = 'https://api.binance.com/api/v1/ticker/price?symbol=LTCBTC';
        try {
            $curl = curl_init();
            if (FALSE === $curl)
                throw new Exception('Failed to initialize request.');

            curl_setopt_array($curl, array(
                CURLOPT_URL => $endpoint,
                CURLOPT_RETURNTRANSFER => true,
                // CURLOPT_ENCODING => "",
                // CURLOPT_MAXREDIRS => 10,
                // CURLOPT_TIMEOUT => 60,
                // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                // CURLOPT_CUSTOMREQUEST => "GET",

                // CURLOPT_PROXY => '127.0.0.0',
                // curl_setopt($ch, CURLOPT_PROXY, $proxy);
                // CURLOPT_PROXYUSERPWD => 'root:202adminAsSSlocal*&^'
                // CURLOPT_PROXY => 'root:202adminAsSSlocal*&^@95.168.190.138:8389',
                // CURLOPT_PROXYTYPE=> CURLPROXY_SOCKS5,

                // CURLOPT_PROXY => 'socks5://127.0.0.1:20800',
            ));


            $response = curl_exec($curl);

            if (FALSE === $response)
                throw new Exception(curl_error($curl), curl_errno($curl));

            $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            if (200 != $http_status)
                throw new Exception($response, $http_status);

            curl_close($curl);
        } catch (Exception $e) {
            $response = $e->getCode() . $e->getMessage();
            echo $response;
        }
        return $response;
    }

    public function Binance($symbol)
    {
        $symbol = strtoupper($symbol);
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
//            echo "<pre>Binance() - Symbol: $symbol <br/>";
//            if (!is_object($response)) {
//                die(var_dump($response) . "<br/>");
//            }
            return $response;
        }
    }

    public function UpdateRepository()
    {
        $coins = Coin::all();
        foreach ($coins as $coin) {
            $name = $coin->name;
            $slug = $coin->slug;
            $response = $this->binance($slug);
//            echo "<pre>UpdateRepository() - Coin: $name - Slug: $slug<br/>";
            $price = $response->price;

            $settings = [
                'price_calculation_method' => Settings::where('name', 'price_calculation_method')->first(),
                'dollar_price_buy' => Settings::where('name', 'dollar_price_buy')->first(),
                'dollar_price_sell' => Settings::where('name', 'dollar_price_sell')->first(),
            ];
            // $usd_price = ($settings['price_calculation_method']->value == 'auto') ? $this->GetDollarPrice() : $settings['dollar_price_sell']->value;
//        $usd_price = ($settings['price_calculation_method']->value == 'auto') ? $this->Nobitex() : $settings['dollar_price_sell']->value;
            $usd_price = ($settings['price_calculation_method']->value == 'auto') ? $this->AbanTether() : $settings['dollar_price_sell']->value;

            $current = Coin::where('slug', $slug)->update([
                'ahead_usd_price' => $current = Coin::where('slug', $slug)->first()->usd_price,
                'ahead_usd_price_1' => $current = Coin::where('slug', $slug)->first()->ahead_usd_price,
                'ahead_usd_price_2' => $current = Coin::where('slug', $slug)->first()->ahead_usd_price_1,
                'ahead_usd_price_3' => $current = Coin::where('slug', $slug)->first()->ahead_usd_price_2,
                'ahead_usd_price_4' => $current = Coin::where('slug', $slug)->first()->ahead_usd_price_3,
                'usd_price' => $price,
                'toman_price' => $this->CalculatePrice($name, 1, $usd_price, 'tomans')
            ]);
        }
//        echo "UpdateRepo - process complete.<br/>";
    }

    /*
     * consider that index should be 'best_buy' or 'best_sell', nothing else allowed.
     * as you see, default will be best_sell, cause it is bigger than the other :)
    */
    public function Nobitex($index = 'best_sell')
    {
        if (Cache::has("usd-price-$index")) {
            return Cache::get("usd-price-$index");
        } else {
            /*** curl get  start ***/
            $url = "http://api.arbazargani.ir/usd.php";
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

            Cache::put("usd-price-$index", substr($response->$index, 0, -1), now()->addMinutes(10));
            return substr($response->$index, 0, -1);
        }
    }

    /*
     * consider that index should be 'best_buy' or 'best_sell', nothing else allowed.
     * as you see, default will be best_sell, cause it is bigger than the other :)
     */
    public function AbanTether($index = 'best_sell')
    {
        if (Cache::has("usd-price-$index")) {
            $this->Debugger(true, "cache has 'usd-price-$index", 0);
            return Cache::get("usd-price-$index");
        } else {
            $agent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/96.0.4664.110 Safari/537.36';
            $this->Debugger(true, "cache doesn't have 'usd-price-$index", 0);
            /*** curl get  start ***/
            $url = "http://api.arbazargani.ir/usd_v2.php";
            $curl = curl_init($url);

            // v1 headers
            /*
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            */

            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_VERBOSE, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_USERAGENT, $agent);
            curl_setopt($curl, CURLOPT_URL,$url);

            //for debug only!
            /*
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            */

            $res = curl_exec($curl);
            $this->Debugger(true, "\$res: " . var_dump($res), 0);
            $response = json_decode($res);
            // header('Content-Type: application/json');
            curl_close($curl);
            // echo json_encode($response);
            $this->Debugger(true, "curl closed, \$response: " . var_dump($response), 0);

            Cache::put("usd-price-$index", $response->$index, now()->addMinutes(10));
            return substr($response->$index, 0, -1);
        }
    }

    public function Debugger($production, $msg, $die = 0)
    {
        if (env('CUSTOM_DEBUGGER') && $production == 'true' && env('APP_ENV') == 'production') {
            echo "$msg<br/>";
            if ($die) {
                die();
            }
        } elseif (env('CUSTOM_DEBUGGER') && $production == 'false' && env('APP_ENV') == 'local') {
            echo "$msg<br/>";
            if ($die) {
                die();
            }
        } else {
            $n = null;
        }
    }
}
