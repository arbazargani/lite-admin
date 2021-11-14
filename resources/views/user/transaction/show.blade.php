@extends('user.template')

@section('content')
    <div class="workspace-wrap">
        <div class="sell-wrap">
            <div class="sell-progress-step">
                <ul>
                    <a href="#">
                        <li>
                           <p class="progress-step-icon">1</p>
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
                           <p class="progress-step-txt">افزودن TxID</p>
                        </li>
                    </a>
                    <i class="fas fa-horizontal-rule"></i>
                    <a href="#">
                        <li>
                           <p class="progress-step-icon">4</p>
                           <p class="progress-step-txt">تایید و پرداخت</p>
                        </li>
                    </a>
                </ul>
                <div class="sell-progress-bar-wrap">
                    <div class="sell-progress-bar sell-progress-bar-2"></div>
                </div>
            </div>
        </div>
        <br>
        <div id="sell-step-2">
            <div class="sell-invoice-accept" style="padding: 5% !important;">
                @if ($transaction->status != 'paid')
                    @php
                        $exptime = \Carbon\Carbon::parse($transaction->created_at)->addMinutes(20);
                        $now = \Carbon\Carbon::parse(date("Y-m-d H:i:s"));
                    @endphp
                    @if( $now > $exptime )
                        <p>مدت زمان پرداخت با توجه به قوانین سایت ۲۰ دقیقه پس از ایجاد صورتحساب می‌باشد.</p>
                        <p>بدین منظور لطفا از بخش <a href="{{ route("User > Sell Coin") }}">فروش</a> یک صورتحساب جدید ایجاد نمایید.</p>
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
                            font-size: 15px;
                            /*background: #ffffff;*/
                            border-radius: 10px 10px 0px 0px;
                            margin-bottom: 10%;
                            margin-top: 10%;
                        }
                        .credit-number {
                            margin: 5px 5px 25px 5px;
                            text-align: center;
                            font-weight: bold;
                            font-size: 30px !important;
                            font-family: 'Inter-Loom';
                            direction: ltr;
                        }
                        .credit-number p {
                            color: white;
                            direction: ltr;
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
                        <div class="bank-cart">
                            <div class="coin-logo">
{{--                                <img width="95px" src="https://cdn1.iconfinder.com/data/icons/cryptocurrency-set-2018/375/Asset_1480-512.png" alt="bitcoin banking">--}}
                                <img width="50px" src="{{ asset('assets/v3/src/icon/' . strtolower(str_replace(['USDT', 'usdt'], null, $transaction->selected_coin)) . '.svg') }}" alt="">
                            </div>
                            <div class="credit-number">
{{--                                <p>{{ substr($transaction->hash, 0, 20) . '...' }}</p>--}}
                                <p style="font-size: 13px">{{ $transaction->hash }}</p>
                            </div>
                            <div class="credit-info">
                                <span class="cvv">***</span>
                                <span class="name">{{ Auth::user($transaction->user_id)->name }}</span>
                            </div>
                        </div>
                        <div>
                            <div>
                                <a href="{{ route('User > Transaction > ADD Tx ID', $transaction->hash) }}" class="btn1"> تایید فاکتور و ثبت TxID</a>
                            </div>
                        </div>
                    @endif
                @else
                    <p>فاکتور مورد نظر در تاریخ {{ Facades\Verta::instance($transaction->paid_at) }} پرداخت شده است.</p>
                    @if (!is_null($transaction->tx_id))
                        <p>TX-ID ثبت شده برای این سفارش:</p>
                        <pre>{{ $transaction->tx_id }}</pre>
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
                                <p>{{ Auth::user($transaction->user_id)->name }}</p>
                            </div>
                            <div>
                                <p class="invoice-info-title">پرداخت توسط:</p>
                                <p>کریپتاینر</p>
                            </div>
                            <div>
                                <p class="invoice-info-title">آدرس: {{ Auth::user($transaction->user_id)->home_address }}</p>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div>
                                <p class="invoice-info-title">روش پرداخت:</p>
                                <p>انتقال به حساب</p>
                            </div>
                            <div>
                               <p class="invoice-info-title">تاریخ صورت حساب:</p>
                               <p>{{ Facades\Verta::instance($transaction->created_at) }}</p>
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
                                    @php $info = explode('|', $transaction->description); @endphp
                                    <td>{{ $info[1] }}</td>
                                    <td>{{ $info[0] }}</td>
                                </tr>
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td>جمع کل:</td>
                                    <td>{{ number_format($transaction->payable) }}</td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="sell-invoice-payment">
                            <p>میزان پرداختی به فروشنده</p>
                            <p>{{ number_format($transaction->payable) }} تومان</p>
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
    {{--<form action="{{ route('Payment > Request', $transaction->id) }}" method="post" onsubmit="return checkForm(this);">--}}
    {{--    @csrf--}}
    {{--    <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">--}}
    {{--        <input class="uk-checkbox" type="checkbox" name="agree_rules" id="agree_rules" required><label--}}
    {{--            for="agree_rules"> قوانین را خوانده و با آنها موافقم.</label>--}}
    {{--    </div>--}}
    {{--    <input type="hidden" name="receipt_id" value="{{ $transaction->id }}">--}}
    {{--    <button class="uk-button uk-button-primary uk-width-1-1" type="submit">پرداخت</button>--}}
    {{--</form>--}}
@endsection
