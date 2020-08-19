@extends('user.template')

@section('content')
<!-- section 2 - bread crumbs -->

<div class="uk-container uk-padding">
    <div uk-grid>
        <div class="uk-width-1-2">
            <ul class="uk-breadcrumb">
                <li><a href="{{ route('User > Panel') }}">ناحیه کاربری</a></li>
                <li><a href="">خرید ارز</a></li>
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
        <div class="uk-alert uk-alert-danger">
            <p><span uk-icon="warning"></span> لطفا در ورود تمامی اطلاعات و صحت آنها دقت نمایید. مسئولیت هرگونه خطای احتمالی با شخص شما خواهد بود.</p>
        </div>
        <div class="uk-alert uk-alert-warning">
            <p><span uk-icon="info"></span> توجه داشته باشید پس از ثبت درخواست، باید از بخش فاکتور ها اقدام به پرداخت نمایید.</p>
        </div>
        <hr>
        <form class="uk-form-horizontal uk-margin-large uk-grid-small" method="post" action="{{ route('User > Receipt > Make') }}" uk-grid>
            @csrf
            <div class="uk-width-1-1">
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-text">آدرس ولت</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="form-horizontal-text" type="text" name="wallet" placeholder="آدرس ولت خود را وارد کنید." required>
                    </div>
                </div>
            </div>

            <div class="uk-width-1-2@m">
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-select">ارز موردنظر</label>
                    <div class="uk-form-controls">
                        <select class="uk-select" id="form-horizontal-select" name="coin">
                            <option value="BTC">بیت کوین</option>
                            <option value="BCH">بیت کوین کش</option>
                            <option value="ETH">اتریوم</option>
                            <option value="LTC">لایت کوین</option>
                            <option value="USDT">تتر</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="uk-width-1-2@m">
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-text">واحد</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="form-horizontal-text" type="text" name="amount" placeholder="مقدار خرید ارز را مشخص نمایید." required>
                    </div>
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
