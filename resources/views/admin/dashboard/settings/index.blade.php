@extends('admin.template')

@section('content')

        <div id="workstation">
            <div id="workspace">
                <div id="admin-settings-wrap">
                    <div class="admin-settings-right">
                        <h3><i class="fad fa-cogs"></i> تنظیمات</h3>
                        <div class="admin-settings-nav">
                            <i class="settigns-bg fad fa-cogs"></i>
                            <ul>
                                <li class="active"><a href="#">تنظیمات سایت</a></li>
                                <li><a href="#">تنظیمات کاربران</a></li>
                                <li><a href="#">تنطیمات محلی</a></li>
                                <li><a href="#"></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="admin-settings-left">
                        <div class="admin-settings-form">
                            @if($errors->any())
                                <div class="uk-alert-danger" uk-alert>
                                    @foreach($errors->all() as $error)
                                        <p>- {{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif
                            <form action="{{ route('Admin > Settings > Update') }}" method="post">
                                @csrf
                                <label>پیغام تایید کاربران:</label>
                                <input type="text" name="user_authorization_success_message" id="" value="{{ $settings['user_authorization_success_message']->value }}">

                                <label>پیغام رد کاربران:</label>
                                <input type="text" name="user_authorization_failed_message" id="" value="{{ $settings['user_authorization_failed_message']->value }}">

                                <label>پیغام نیاز به تایید کاربران:</label>
                                <input type="text" name="user_authorization_needed_message" id="" value="{{ $settings['user_authorization_needed_message']->value }}">

                                <div class="dollar-toggle-switch-wrap clearfix">
                                    <p>وارد کردن دستی قیمت دلار</p>
                                    <label class="switch">
                                        <input type="checkbox" name="price_calculation_method" value="1" @if($settings['price_calculation_method']->value == 'custom') checked @endif>
                                        <span class="slider round"></span>
                                    </label>
                                </div>

                                <label>قیمت خرید دلار (تومان):</label>
                                <input type="text" name="dollar_price_buy" id="" value="{{ $settings['dollar_price_buy']->value }}">

                                <label>قیمت فروش دلار (تومان):</label>
                                <input type="text" name="dollar_price_sell" id="" value="{{ $settings['dollar_price_sell']->value }}">

                                <label>ولت BTC:</label>
                                <input type="text" name="public_btc_wallet" id="" value="{{ $settings['public_btc_wallet']->value }}">

                                <label>ولت USDT:</label>
                                <input type="text" name="public_usdt_wallet" id="" value="{{ $settings['public_usdt_wallet']->value }}">

                                <input type="submit" class="btn1" value="ذخیره">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
