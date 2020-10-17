<?php

namespace App\Http\Controllers;

use App\Settings;
use App\User;
use App\LogTrait;
use Auth;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    use LogTrait;
    public function Show() {
        $settings = [
            'user_authorization_success_message' => Settings::where('name', 'user_authorization_success_message')->first(),
            'user_authorization_failed_message' => Settings::where('name', 'user_authorization_failed_message')->first(),
            'user_authorization_needed_message' => Settings::where('name', 'user_authorization_needed_message')->first(),
            'price_calculation_method' => Settings::where('name', 'price_calculation_method')->first(),
            'dollar_price_buy' => Settings::where('name', 'dollar_price_buy')->first(),
            'dollar_price_sell' => Settings::where('name', 'dollar_price_sell')->first(),
            'application_start_time' => Settings::where('name', 'application_start_time')->first(),
            'application_close_time' => Settings::where('name', 'application_close_time')->first(),
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
//            'price_calculation_method' => 'required',
            'dollar_price_buy' => 'required|numeric|min:2',
            'dollar_price_sell' => 'required|numeric|min:2',
            'application_start_time' => 'required',
            'application_close_time' => 'required',
            'public_btc_wallet' => 'min:10',
            'public_usdt_wallet' => 'min:10',
        ]);

        Settings::where('name', 'user_authorization_success_message')->update(['value' => $request['user_authorization_success_message']]);
        Settings::where('name', 'user_authorization_failed_message')->update(['value' => $request['user_authorization_failed_message']]);
        Settings::where('name', 'user_authorization_needed_message')->update(['value' => $request['user_authorization_needed_message']]);
        $method = ($request->has('price_calculation_method') && $request['price_calculation_method'] == 1) ? 'custom' : 'auto';
        Settings::where('name', 'price_calculation_method')->update(['value' => $method]);
        Settings::where('name', 'dollar_price_buy')->update(['value' => $request['dollar_price_buy']]);
        Settings::where('name', 'dollar_price_sell')->update(['value' => $request['dollar_price_sell']]);
        Settings::where('name', 'application_start_time')->update(['value' => $request['application_start_time']]);
        Settings::where('name', 'application_close_time')->update(['value' => $request['application_close_time']]);
        Settings::where('name', 'public_btc_wallet')->update(['value' => $request['public_btc_wallet']]);
        Settings::where('name', 'public_usdt_wallet')->update(['value' => $request['public_usdt_wallet']]);

        $log = 'User ' . Auth::id() . '-' . User::find(Auth::id())->name . '-' . User::find(Auth::id())->email . '-' . ' Updated the settings.';
        $this->MakeLog(Auth::id(), $log);
        return back();
    }
}
