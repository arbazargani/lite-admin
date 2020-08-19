@extends('admin.template')

@section('content')
    <!-- section 2 - bread crumbs -->

    <div class="uk-container uk-padding">
        <div uk-grid>
            <div class="uk-width-1-2">
                <ul class="uk-breadcrumb">
                    <li><a href="{{ route('Admin > Dashboard') }}">پنل مدیریت</a></li>
                    <li><a href="">تنظیمات سیستم</a></li>
                </ul>
            </div>

            <div class="uk-width-1-2">
                <span class="uk-float-left"><a href="" uk-icon="icon: cloud-download" uk-tooltip="بروزرسانی"></a></span>
            </div>
        </div>
    </div>

    <!-- section 2 - bread crumbs -->

    <!-- section 3 - settings series -->

    <div class="uk-container uk-padding">
        <div class="uk-card uk-card-default uk-card-body uk-border-rounded">
            @if($errors->any())
            <div class="uk-alert-danger" uk-alert>
            @foreach($errors->all() as $error)
                <p>- {{ $error }}</p>
            @endforeach
            </div>
            @endif
            <form action="{{ route('Admin > Settings > Update') }}" method="post">
                @csrf
                <fieldset class="uk-fieldset">

                    <legend class="uk-legend">تنظیمات سیستم</legend>

                    <div class="uk-margin">
                        <label class="uk-form-label" for="form-stacked-text">پیام تایید کاربران</label>
                        <input class="uk-input" type="text" placeholder="user_authorization_success_message" name="user_authorization_success_message" value="{{ $settings['user_authorization_success_message']->value }}">
                    </div>

                    <hr class="uk-margin-medium">

                    <div class="uk-margin">
                        <label class="uk-form-label" for="form-stacked-text">پیام عدم تایید کاربران</label>
                        <input class="uk-input" type="text" placeholder="user_authorization_failed_message" name="user_authorization_failed_message" value="{{ $settings['user_authorization_failed_message']->value }}">
                    </div>

                    <hr class="uk-margin-medium">

                    <div class="uk-margin">
                        <label class="uk-form-label" for="form-stacked-text">پیام عدم احراز هویت</label>
                        <input class="uk-input" type="text" placeholder="user_authorization_needed_message" name="user_authorization_needed_message" value="{{ $settings['user_authorization_needed_message']->value }}">
                    </div>

                    <hr class="uk-margin-medium">

                    <div class="uk-margin uk-child-width-1-2" uk-grid>
                        <div>
                            <label class="uk-form-label" for="form-stacked-text">نحوه محاسبه قیمت</label>
                            <select class="uk-select" name="price_calculation_method">
                                <option value="auto" @if($settings['price_calculation_method']->value == 'auto') selected @endif>محاسبه اتوماتیک قیمت</option>
                                <option value="custom" @if($settings['price_calculation_method']->value == 'custom') selected @endif>محسابه بر حسب نرخ دستی دلار</option>
                            </select>
                        </div>
                        <div>
                            <label class="uk-form-label" for="form-stacked-text">نرخ دلار</label>
                            <input class="uk-input" type="number" placeholder="dollar_price" name="dollar_price" value="{{ $settings['dollar_price']->value }}">
                        </div>
                    </div>

                    <hr class="uk-margin-medium">

                    <div class="uk-margin uk-child-width-1-2@m" uk-grid>
                        <div>
                            <label class="uk-form-label" for="form-stacked-text">ولت بیت‌کوین</label><br>
                            <img src="/assets/wallets/BTC-WALLET.jpg" class="uk-width-1-2" alt="PUBLIC BTC WALLET">
                            <input class="uk-input" type="text" placeholder="public_btc_wallet" name="public_btc_wallet" value="{{ $settings['public_btc_wallet']->value }}">
                        </div>
                        <div>
                            <label class="uk-form-label" for="form-stacked-text">ولت تتر</label><br>
                            <img src="/assets/wallets/USDT-WALLET.jpg" class="uk-width-1-2" alt="PUBLIC USDT WALLET">
                            <input class="uk-input" type="text" placeholder="pubic_usdt_wallet" name="public_usdt_wallet" value="{{ $settings['public_usdt_wallet']->value }}">
                        </div>
                    </div>

                    <hr class="uk-margin-medium">

                    <div class="uk-margin">
                        <button class="uk-button uk-button-primary uk-width-1-1" type="submit">ذخیره</button>
                    </div>

                </fieldset>

            </form>
        </div>
    </div>

    <!-- section 3 - settings series -->


@endsection
