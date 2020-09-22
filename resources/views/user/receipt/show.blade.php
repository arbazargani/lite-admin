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
            <style>
                .sell-invoice-wrap {
                    max-width: 48% !important;
                }
            </style>
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
                                <p>{{ env('APP_NAME') }}</p>
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
            <br>
            <div class="sell-invoice-accept">
                @php
                    $exptime = \Carbon\Carbon::parse($receipt->created_at)->addMinutes(20);
                    $now = \Carbon\Carbon::parse(date("Y-m-d H:i:s"));
                @endphp
                @if( $now > $exptime )
                    <p>مدت زمان پرداخت با توجه به قوانین سایت ۲۰ دقیقه پس از ایجاد صورتحساب می‌باشد.</p>
                    <p>بدین منظور لطفا از بخش <a href="{{ route("User > Buy Coin") }}">خرید</a> یک صورتحساب جدید ایجاد نمایید.</p>
                @else
                    <div>
                        <form action="{{ route('Payment > Request', $receipt->id) }}" method="post">
                            @csrf
                            <button type="submit" class="button td-btn">پرداخت</button>
                        </form>
                    </div>
                @endif
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
