<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OneAPI\Laravel\API\Crypto;
use OneAPI\Laravel\API\Currency;

use App\StringTrait;
use App\Settings;
use Exception;
use Binance\API;
use Carbon\Carbon;

class CoinController extends Controller
{
    use StringTrait;

    public function GetDollarPrice() {
    $response = Currency::usd();
    return $response[0]->price;
}

    public function COIN_TO_USD($currency) {
        if ($currency == 'bitcoin') {

            $response = Crypto::btc();

        } elseif($currency == 'litecoin') {

            $response = Crypto::ltc();

        } elseif($currency == 'ethereum') {

            $response = Crypto::eth();

        } else {

            return abort('403', 'ارز موردنظر پشتیبانی نمیشود.');

        }

        return $response->price;
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
            ];

            $usd_price = ($settings['price_calculation_method']->value == 'auto') ? $this->GetDollarPrice() : $settings['dollar_price_sell']->value;;

            $array = array('ok' => true,
                'dollars' => number_format($this->COIN_TO_USD($request['currency-in'])),
                'tomans' => number_format($this->CalculatePrice($request['currency-in'], $request['amount'], $usd_price, 'tomans')),
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
            ];

            $usd_price = ($settings['price_calculation_method']->value == 'auto') ? $this->GetDollarPrice() : $settings['dollar_price_buy']->value;;

            $array = array('ok' => true,
                'dollars' => number_format($this->COIN_TO_USD($request['currency-in'])),
                'tomans' => number_format($this->CalculatePrice($request['currency-in'], $request['amount'], $usd_price, 'tomans')),
            );
            return json_encode($array);
        }
    }
    public function Binance() {
        $endpoint = 'https://api.binance.com/api/v3/ticker/price?symbol=LTCBTC&timestamp=' . Carbon::now()->toDateTimeString();
        try
        {
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
        }
        catch(Exception $e)
        {
            $response= $e->getCode() . $e->getMessage();
            echo $response;
        }
        return $response;
    }

    public function Binance_v2() {
        $url = $endpoint = 'https://api.binance.com/api/v1/ticker/price?symbol=LTCBTC';
        
        
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array("OneAPI-Key: $key"));
        $response = curl_exec($ch);

        $json = json_decode($response);

        return var_dump($json);
    }
    public function Binance_v3() {
        $key = "ThzJPQ6k32JEQQtvtAmt4gMqcbELDdRqPl9RG5NnIur27zCdKIk7AA3Mf6sEEao2";
        $secret = "vEKoKnJ5QeT99mgjcsqyABsvBfsTe6PsKGGEz5UasWedWE7HZ7NmnX6htiMNhTen";
        $api = new \Binance\API($key, $secret);

        $price = $api->price("BNBBTC");
        return $price;
    }
}
