<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OneAPI\Laravel\API\Crypto;
use OneAPI\Laravel\API\Currency;

use App\StringTrait;
use App\Settings;

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
                'user_authorization_success_message' => Settings::where('name', 'user_authorization_success_message')->first(),
                'user_authorization_failed_message' => Settings::where('name', 'user_authorization_failed_message')->first(),
                'user_authorization_needed_message' => Settings::where('name', 'user_authorization_needed_message')->first(),
                'price_calculation_method' => Settings::where('name', 'price_calculation_method')->first(),
                'dollar_price_buy' => Settings::where('name', 'dollar_price_buy')->first(),
                'dollar_price_sell' => Settings::where('name', 'dollar_price_sell')->first(),
                'public_btc_wallet' => Settings::where('name', 'public_btc_wallet')->first(),
                'public_usdt_wallet' => Settings::where('name', 'public_usdt_wallet')->first(),
            ];

            $usd_price = ($settings['price_calculation_method']->value == 'auto') ? $this->GetDollarPrice() : $settings['dollar_price_sell']->value;;

            $array = array('ok' => true,
                'dollars' => number_format($this->COIN_TO_USD($request['currency-in'])),
                'tomans' => number_format($this->CalculatePrice($request['currency-in'], $request['amount'], $usd_price, 'tomans')),
            );
            return json_encode($array);
        }
    }
}
