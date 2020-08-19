<?php

namespace App\Http\Controllers;

use App\Settings;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function Show() {
        $settings = [
            'user_authorization_success_message' => Settings::where('name', 'user_authorization_success_message')->first(),
            'user_authorization_failed_message' => Settings::where('name', 'user_authorization_failed_message')->first(),
            'user_authorization_needed_message' => Settings::where('name', 'user_authorization_needed_message')->first(),
            'price_calculation_method' => Settings::where('name', 'price_calculation_method')->first(),
            'dollar_price' => Settings::where('name', 'dollar_price')->first(),
            'public_btc_wallet' => Settings::where('name', 'public_btc_wallet')->first(),
            'public_usdt_wallet' => Settings::where('name', 'public_usdt_wallet')->first(),
        ];

        return view('admin.dashboard.settings.index', compact(['settings']));
    }

    public function Update(Request $request)
    {
        $request->validate([
            'user_authorization_success_message' => 'min:10',
            'user_authorization_failed_message' => 'min:10',
            'user_authorization_needed_message' => 'min:10',
            'price_calculation_method' => 'required',
            'dollar_price' => 'required|numeric|min:2',
            'public_btc_wallet' => 'min:10',
            'public_usdt_wallet' => 'min:10',
        ]);

        Settings::where('name', 'user_authorization_success_message')->update(['value' => $request['user_authorization_success_message']]);
        Settings::where('name', 'user_authorization_failed_message')->update(['value' => $request['user_authorization_failed_message']]);
        Settings::where('name', 'user_authorization_needed_message')->update(['value' => $request['user_authorization_needed_message']]);
        Settings::where('name', 'price_calculation_method')->update(['value' => $request['price_calculation_method']]);
        Settings::where('name', 'dollar_price')->update(['value' => $request['dollar_price']]);
        Settings::where('name', 'public_btc_wallet')->update(['value' => $request['public_btc_wallet']]);
        Settings::where('name', 'public_usdt_wallet')->update(['value' => $request['public_usdt_wallet']]);

        return back();
    }
}
