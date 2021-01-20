<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Jobs\SendReceiptCreationMail;
use App\Jobs\SendReceiptPaidMail;
use App\Jobs\SendSms;

class ActionController extends Controller
{
    public function SendSms($information) {
        if (!array_key_exists('to', $information) || !array_key_exists('text', $information)) {
            return;
        }

        
        try {

            ini_set("soap.wsdl_cache_enabled", 0);
            $sms = new \SoapClient("http://api.payamak-panel.com/post/Send.asmx?wsdl", array("encoding"=>"UTF-8"));
            
            $data = array(
                "username" => env('meli_payamak_username'),
                "password" => env('meli_payamak_password'),
                "to" => array($information['to']),
                "from" => env('meli_payamak_send_number'),
                "text" => $information['text'],
                "isflash" => false
            );
            
            $result = $sms->SendSimpleSMS($data)->SendSimpleSMSResult;
        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    public function SendEmail($information) {
        //
    }

    Public function SendOtp() {
        //
    }

}
