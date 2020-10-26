@extends('admin.template')

@section('content')

        <div id="workstation">
            <div id="workspace">
                <div id="admin-settings-wrap">
                    <div class="admin-settings-right">
                        <h3><i class="fad fa-cogs"></i> تنظیمات</h3>
                        <div class="admin-settings-nav">
                            <ul>
                                <li class="active"><a href="{{ route('Admin > Settings > Show') }}">تنظیمات سایت</a></li>
                                <li><a href="#">تنظیمات کاربران</a></li>
                                <li><a href="#">تنطیمات محلی</a></li>
                                <li><a href="{{ route('Admin > Settings > Coins') }}">تنظیمات ارزهای سیستم</a></li>
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

                                <label>ساعت شروع فعالیت سایت:</label>
                                {{-- <input type="text" name="dollar_price_sell" id="" value="{{ $settings['dollar_price_sell']->value }}"> --}}
                                <input type="text" name="application_start_time" class="form-control start-picker" value="{{ $settings['application_start_time']->value }}">
                                <div class="start-container"></div>
                                
                                <script>
                                    new Picker(document.querySelector('.start-picker'), {
                                        format: 'HH:mm',
                                        container: '.start-container',
                                        inline: false,
                                        controls: true,
                                        headers: true,
                                        inline: false,
                                        text: {
                                            title: 'ساعت را انتخاب نمایید',
                                            hour: 'ساعت',
                                            minute: 'دقیقه',
                                        },
                                    });
                                </script>


                                <label>ساعت اتمام فعالیت سایت:</label>
                                {{-- <input type="text" name="dollar_price_sell" id="" value="{{ $settings['dollar_price_sell']->value }}"> --}}
                                <input type="text" name="application_close_time" class="form-control end-picker" value="{{ $settings['application_close_time']->value }}">
                                <div class="end-container"></div>

                                <script>
                                    new Picker(document.querySelector('.end-picker'), {
                                        format: 'HH:mm',
                                        container: '.end-container',
                                        inline: false,
                                        controls: true,
                                        headers: true,
                                        text: {
                                            title: 'ساعت را انتخاب نمایید',
                                            hour: 'ساعت',
                                            minute: 'دقیقه',
                                            ok: 'تایید',
                                            cancell: 'لغو',
                                        },
                                    });
                                </script>

                                <label>ولت BTC:</label>
                                <input type="text" name="public_btc_wallet" id="" value="{{ $settings['public_btc_wallet']->value }}">

                                <label>ولت USDT:</label>
                                <input type="text" name="public_usdt_wallet" id="" value="{{ $settings['public_usdt_wallet']->value }}">

                                <div style="background: #ffd7d7; border: 1px solid lightcoral; padding: 2%; margin: 2% 0">
                                    <p>بدون تایید پشتیبان سامانه این موارد را تغییر ندهید.</p>
                                    <label>متا title:</label>
                                    <input type="text" name="application_index_meta_title" id="" value="{{ $settings['application_index_meta_title']->value }}">

                                    <label>متا description:</label>
                                    <input type="text" name="application_index_meta_description" id="" value="{{ $settings['application_index_meta_description']->value }}">

                                    <label>متا keyword:</label>
                                    <input type="text" name="application_index_meta_keyword" id="" value="{{ $settings['application_index_meta_keyword']->value }}">

                                    <label>متا robots:</label>
                                    <input type="text" name="application_index_meta_robots" id="" value="{{ $settings['application_index_meta_robots']->value }}">

                                    <div class="dollar-toggle-switch-wrap clearfix">
                                        <p>بلاک کردن دسترسی کاربران غیر ایرانی</p>
                                        <label class="switch">
                                            <input type="checkbox" name="check_region" value="1" @if($settings['check_region']->value == '1') checked @endif>
                                            <span class="slider round"></span>
                                        </label>
                                    </div>
                                </div>
                                <input type="submit" class="btn1" value="ذخیره">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
