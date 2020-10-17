<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OneAPI\Laravel\API\Crypto;
use OneAPI\Laravel\API\Currency;

use App\Settings;

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

        return view('public.home.index', compact(['settings']));
    }
}
