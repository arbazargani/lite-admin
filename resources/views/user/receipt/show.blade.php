@extends('user.template')

@section('content')
    <div class="workspace-wrap">
        <div class="sell-wrap">
            <div class="sell-progress-step">
                <ul>
                    <a href="#">
                        <li>
                            <p class="progress-step-icon step-icon-active">1</p>
                            <p class="progress-step-txt">مقدار ارز</p>
                        </li>
                    </a>
                    <i class="fas fa-horizontal-rule"></i>
                    <a href="#">
                        <li>
                            <p class="progress-step-icon step-icon-active">2</p>
                            <p class="progress-step-txt">تایید فاکتور</p>
                        </li>
                    </a>
                    <i class="fas fa-horizontal-rule"></i>
                    <a href="#">
                        <li>
                            <p class="progress-step-icon">3</p>
                            <p class="progress-step-txt">پرداخت</p>
                        </li>
                    </a>
                    {{-- <i class="fas fa-horizontal-rule"></i>
                    <a href="#">
                        <li>
                            <p class="progress-step-icon">4</p>
                            <p class="progress-step-txt">تایید و پرداخت</p>
                        </li>
                    </a> --}}
                </ul>
                <div class="sell-progress-bar-wrap">
                    <div class="sell-progress-bar sell-progress-bar-3"></div>
                </div>
            </div>
        </div>
        <br>
        <div id="sell-step-2">
            <div class="sell-invoice-accept" style="padding: 5% !important;">
                @if ($receipt->status != 'paid')
                    @php
                        $exptime = \Carbon\Carbon::parse($receipt->created_at)->addMinutes(20);
                        $now = \Carbon\Carbon::parse(date("Y-m-d H:i:s"));
                    @endphp
                    @if( $now > $exptime )
                        <p>مدت زمان پرداخت با توجه به قوانین سایت ۲۰ دقیقه پس از ایجاد صورتحساب می‌باشد.</p>
                        <p>بدین منظور لطفا از بخش <a href="{{ route("User > Buy Coin") }}">خرید</a> یک صورتحساب جدید ایجاد نمایید.</p>
                    @else
                    <style>
                        .bank-cart {
                            margin: auto;
                            border-radius: 15px;
                            padding: 5px;
                            height: 250px;
                            color: white;
                            margin-bottom: 3%;
                            background: #0F2027;  /* fallback for old browsers */
                            background: -webkit-linear-gradient(to right, #2C5364, #203A43, #0F2027);  /* Chrome 10-25, Safari 5.1-6 */
                            background: linear-gradient(to right, #2C5364, #203A43, #0F2027); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
                            max-width: 400px;
                        }
                        .coin-logo {
                            text-align: center;
                            font-size: 50px;
                            background: #ffffff;
                            border-radius: 10px 10px 0px 0px;
                            margin-bottom: 10%
                        }
                        .credit-number {
                            margin: 5px 5px 25px 5px;
                            text-align: center;
                            font-weight: bold;
                            font-size: 30px !important;
                            font-family: 'Inter-Loom';
                            direction: ltr
                        }
                        .credit-info {
                            text-align: center;
                            padding: 5px 15px 5px 15px;
                        }
                        .cvv {
                            float: right;
                        }
                        .name {
                            float: left;
                            font-family: 'iranyekan'
                        }
                    </style>
{{--                        <div class="bank-cart">--}}
{{--                            <div class="coin-logo">--}}
{{--                                <img width="95px" src="https://cdn1.iconfinder.com/data/icons/cryptocurrency-set-2018/375/Asset_1480-512.png" alt="bitcoin banking">--}}
{{--                            </div>--}}
{{--                            <div class="credit-number">--}}
{{--                                <span>{{ Auth::user($receipt->user_id)->credit_card }}</span>--}}
{{--                            </div>--}}
{{--                            <div class="credit-info">--}}
{{--                                <span class="cvv">***</span>--}}
{{--                                <span class="name">{{ Auth::user($receipt->user_id)->name }}</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div>
                            @php
                                /*
                                <form action="{{ route('Ipg > Request', $receipt->hash) }}" method="post">
                                    @csrf
                                    <button type="submit" class="button td-btn">پرداخت</button>
                                </form>
                                */
                            @endphp
                            @if(is_null($receipt->receipt_file) && $receipt->status == 'unpaid')
                                <div style="direction: rtl; text-align: right">
                                    @php
                                        $bank_info = json_decode($payment_account->value);
                                    @endphp
                                    <h3 style="padding: 4px 10px; border-radius: 3px; color: #ca3232; font-weight: bold; text-align: right">توجه داشته باشید:</h3>
                                    <p style="padding: 4px 10px; border-radius: 3px; background: #ffcbcb; font-size: 13px; font-weight: bold">- مسئولیت هرگونه اشتباه در واریز با شما خواهد بود.
                                    <br>
                                    - اعتبار این فاکتور تنها تا ۲۰ دقیقه پس از ایجاد می‌باشد.
                                    <br>
                                    - پسوندی بجز jpg و یا png برای رسید پرداخت قابل قبول نیست.
                                    <br>
                                    - حجم فایل رسید نباید از ۳ مگابایت بیشتر باشد.
                                    </p>
                                    <hr>
                                    <p>شماره حساب: {{ $bank_info->hesab }}</p>
                                    <p>شماره شبا: {{ $bank_info->sheba }}</p>
                                    <p>شماره کارت: {{ $bank_info->number }}</p>
                                    <p>{{ $bank_info->info }}</p>
                                </div>
                                @if ($errors->any())
                                    <p style="padding: 4px 10px; border-radius: 3px; background: #ffcbcb; font-size: 13px; font-weight: bold">
                                    @foreach ($errors->all() as $error)
                                            <span>{{$error}}</span><br/>
                                    @endforeach
                                    </p>
                                @endif
                                <form action="{{ route('Upload > UploadPaymentReceipt', $receipt->hash) }}" enctype="multipart/form-data"  method="post">
                                    @csrf
                                <center>
                                        <input type="file" name="receipt_file" id="receipt_file" style="display: none" required/>
                                        <label for="receipt_file"><h5 class="button" style="background: #00b38a">مرحله ۱ - برای انتخاب رسید پرداخت کلید کنید</h5></label>
                                </center>
                                <hr>
                                    <button type="submit" class="button td-btn">مرحله ۲ - بارگذاری رسید</button>
                                </form>
                            @else
                                <span>رسید پرداخت شما دریافت شد.</span>
                                <img src="/{{ str_replace('public', 'storage', $receipt->receipt_file) }}" style="max-width: 200px" alt="" srcset="">
                            @endif
                        </div>
                    @endif
                @else
                    <p>فاکتور مورد نظر در تاریخ {{ Facades\Verta::instance($receipt->paid_at) }} پرداخت شده است.</p>
                    <img src="/{{ str_replace('public', 'storage', $receipt->receipt_file) }}" style="max-width: 200px" alt="" srcset="">
                    @if (!is_null($receipt->admin_tx))
                        <p>TX-ID ثبت شده برای این سفارش:</p>
                        <pre>{{ $receipt->admin_tx }}</pre>
                    @endif
                @endif
            </div>
            <div class="sell-invoice-wrap">
                <div class="sell-invoice">
                    <div class="sell-invoice-title">
                        <h3>صورت حساب</h3>
                    </div>
                    <div class="sell-invoice-info clearfix">
                        <div class="row clearfix">
                            <div>
                                <p class="invoice-info-title">صورت حساب برای:</p>
                                <p>{{ Auth::user($receipt->user_id)->name }}</p>
                            </div>
                            <div>
                                <p class="invoice-info-title">پرداخت به:</p>
                                <p>کریپتاینر</p>
                            </div>
                            <div>
                                <p class="invoice-info-title">آدرس: {{ Auth::user($receipt->user_id)->home_address }}</p>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div>
                                <p class="invoice-info-title">روش پرداخت:</p>
                                <p>انتقال به حساب</p>
                            </div>
                            <div>
                               <p class="invoice-info-title">تاریخ صورت حساب:</p>
                               <p>{{ Facades\Verta::instance($receipt->created_at) }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="sell-invoice-table-wrap">
                        <div class="sell-invoice-table-title">
                            <h3>اقلام صورت حساب</h3>
                        </div>
                        <div class="sell-invoice-table">
                            <table>
                                <thead>
                                <tr>
                                    <td>توضیحات</td>
                                    <td>مقدار</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    @php $info = explode('|', $receipt->description); @endphp
                                    <td>{{ $info[1] }}</td>
                                    <td>{{ $info[0] }}</td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td>جمع کل:</td>
                                    <td>{{ number_format($receipt->payable) }}</td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="sell-invoice-payment">
                            <p>میزان پرداختی به فروشنده</p>
                            <p>{{ number_format($receipt->payable) }} تومان</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--<script>--}}

    {{--    function checkForm(form) {--}}
    {{--        if (!form.agree_rules.checked) {--}}
    {{--            window.alert("Please indicate that you accept the Terms and Conditions");--}}
    {{--            form.terms.focus();--}}
    {{--            return false;--}}
    {{--        }--}}
    {{--        return true;--}}
    {{--    }--}}
    {{--</script>--}}
    {{--<form action="{{ route('Payment > Request', $receipt->id) }}" method="post" onsubmit="return checkForm(this);">--}}
    {{--    @csrf--}}
    {{--    <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">--}}
    {{--        <input class="uk-checkbox" type="checkbox" name="agree_rules" id="agree_rules" required><label--}}
    {{--            for="agree_rules"> قوانین را خوانده و با آنها موافقم.</label>--}}
    {{--    </div>--}}
    {{--    <input type="hidden" name="receipt_id" value="{{ $receipt->id }}">--}}
    {{--    <button class="uk-button uk-button-primary uk-width-1-1" type="submit">پرداخت</button>--}}
    {{--</form>--}}
@endsection
