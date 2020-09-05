@extends('user.template')

@section('content')
<!-- section 2 - bread crumbs -->

<div class="uk-container uk-padding">
    <div uk-grid>
        <div class="uk-width-1-2">
            <ul class="uk-breadcrumb">
                <li><a href="{{ route('User > Panel') }}">ناحیه کاربری</a></li>
                <li><a href="">تبدیل ارز</a></li>
            </ul>
        </div>

        <div class="uk-width-1-2">
            <span class="uk-float-left"><a href="" uk-icon="icon: cloud-download" uk-tooltip="بروزرسانی"></a></span>
        </div>
    </div>
</div>

<!-- section 2 - bread crumbs -->

<!-- section 3 - tranaction request form -->

<div class="uk-container uk-padding">
    <div class="uk-card uk-card-default uk-card-body uk-border-rounded">
        <div class="uk-alert uk-alert-success">
            <p><span uk-icon="warning"></span> درخواست خود را ثبت کنید. همکاران ما پس از بررسی با شما تماس خواهند گرفت.</p>
        </div>
        <div class="uk-alert uk-alert-warning">
            <p><span uk-icon="info"></span> ولت عمومی سایت: {{ env('PublicWallet') }}</p>
        </div>
        @if($errors->any())
        <div class="uk-alert uk-alert-danger">
        @foreach($errors->all() as $error)
            <p><span uk-icon="info"></span> {{ $error }}</p>
        @endforeach
        </div>
        @endif
        <hr>
        <form class="uk-form-horizontal uk-margin-large uk-grid-small" method="post" action="{{ route('User > Exchange > Make') }}" uk-grid>
            @csrf
            <input type="hidden" name="receipt_type" value="sell">
            <div class="uk-width-1-3@m">
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-select">ارز مبدا</label>
                    <div class="uk-form-controls">
                        <select class="uk-select" id="form-horizontal-select" name="from_coin">
                            <option value="BTC">بیت کوین</option>
                            <option value="BCH">بیت کوین کش</option>
                            <option value="ETH">اتریوم</option>
                            <option value="LTC">لایت کوین</option>
                            <option value="USDT">تتر</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="uk-width-1-3@m">
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-text">واحد</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="form-horizontal-text" type="text" name="amount" placeholder="مقدار فروش ارز را مشخص نمایید." required>
                    </div>
                </div>
            </div>

            <div class="uk-width-1-3@m">
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-select">ارز مقصد</label>
                    <div class="uk-form-controls">
                        <select class="uk-select" id="form-horizontal-select" name="to_coin">
                            <option value="BTC">بیت کوین</option>
                            <option value="BCH">بیت کوین کش</option>
                            <option value="ETH">اتریوم</option>
                            <option value="LTC">لایت کوین</option>
                            <option value="USDT">تتر</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="uk-width-1-1">
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-select">آدرس ولت</label>
                    <input class="uk-input" id="form-horizontal-text" type="text" name="user_wallet" placeholder="آدرس ولت خود را وارد کنید." required>
                </div>
            </div>


            <div class="uk-width-1-1">
                <div class="uk-margin">
                    <button class="uk-button uk-button-primary uk-align-center uk-align-left@m"type="submit">ثبت درخواست</button>
                </div>
            </div>

        </form>
    </div>
</div>

<!-- section 3 - tranaction request form -->


@endsection
