<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exchange;
use Auth;

class ExchangeController extends Controller
{
    public function CalculateUSDPrice($currency, $amount)
    {
        if (env('API_DOWN')) {
            $array = array('ok' => false,
                'error' => 'System under maintenance.'
            );
            return json_encode($array);
        }
        $in = $currency;
        $to = 'USD';
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

    public function ExchangeCoin()
    {
        return view("user.panel.exchange");
    }

    public function MakeExchange(Request $request)
    {
        $request->validate([
            'from_coin' => 'required',
            'amount' => 'required',
            'to_coin' => 'required',
            'user_wallet' => 'required|min:10'
        ]);
        $exchange = new Exchange();
        $exchange->user_id = Auth::user()->id;
        $exchange->from_coin = $request['from_coin'];
        $exchange->amount = $request['amount'];
        $exchange->to_coin = $request['to_coin'];
        $exchange->user_wallet = $request['user_wallet'];


        $from_coin_one_unit_price = $this->CalculateUSDPrice($request['from_coin'], 1);
        $from_coin_one_unit_price = json_decode($from_coin_one_unit_price)->price_to_dollar;
        $from_coin_one_unit_price = (float) str_replace([',', '$'], '', $from_coin_one_unit_price);

        $to_coin_one_unit_price = $this->CalculateUSDPrice($request['to_coin'], 1);
        $to_coin_one_unit_price = json_decode($to_coin_one_unit_price)->price_to_dollar;
        $to_coin_one_unit_price = (float) str_replace([',', '$'], '', $to_coin_one_unit_price);

        $payable = $request['amount']*($from_coin_one_unit_price/1)*(1/$to_coin_one_unit_price);

//        echo $request['amount'] . ' ' . $request['to_coin'] . "<hr>";
//        return $payable;

        $exchange->payable = $payable;
        $exchange->description = 'تبدیل' . $request['amount'] . ' '  . $request['from_coin'] . ' | معادل  ' . $payable . '  ' . $request['to_coin'];
        $exchange->save();

        $message = 'درخواست شما ثبت شد و از طریق بخش تبدیل ارز قابل پیگیری است.';
        session(['status' => 'factored', 'message' => $message]);
        return redirect(route('User > Panel'));
    }

    public function AdminAddTX(Request $request, $id)
    {
        $exchange = Exchange::findOrFail($id);
        return $exchange;
    }

    public function UserAddTX(Request $request, $id)
    {
        //
    }

    public function DoTheWhat()
    {

    }
}
