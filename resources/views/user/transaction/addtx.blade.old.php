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
                            <p class="progress-step-icon step-icon-active">3</p>
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
                    <div class="sell-progress-bar sell-progress-bar-3"></div>
                </div>
            </div>
        </div>
        <br>
        <div id="sell-step-2">
            <style>
                #sell-step-2 .wrapper {
                    width: 100%;
                }
            </style>
            <div class="wrapper">
                @if(is_null($transaction->tx_id))
                <div style="padding: 2px 10px 2px 10px; margin-bottom: 7px;">
                    <div style="width: 45%; float: left">
                        <h2>ولت بیت‌کوین</h2>
                        <img src="/assets/wallets/BTC-WALLET.jpg" alt="ولت بیت‌کوین" style="max-width: 200px;">
                        <pre>{{ $settings['public_btc_wallet']->value }}</pre>
                    </div>
                    <div style="width: 45%; float: right">
                        <h2>ولت تتر</h2>
                        <img src="/assets/wallets/USDT-WALLET.jpg" alt="ولت تتر" style="max-width: 200px;">
                        <pre>{{ $settings['public_usdt_wallet']->value }}</pre>
                    </div>
                </div>
                <div>
                    <form action="{{ route('User > Transaction > ADD Tx ID', $transaction->hash) }}" method="post" style="text-align: center">
                        @csrf
                        <input type="text" name="tx_id" placeholder="شناسه TxID انتقال را وارد نمایید." required>
                        <input type="hidden" name="transaction_id" value="{{ $transaction->hash }}">
                        <br>
                        <button type="submit" class="btn1">ثبت</button>
                    </form>
                </div>
                @else
                <div>
                    <p>شناسه <span style="background: #f3f3f3; padding: 0.5%; border: 1px solid green; border-radius: 3px; color: green;">{{ $transaction->tx_id }}</span> برای این پرداخت ثبت شده است.</p>
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
