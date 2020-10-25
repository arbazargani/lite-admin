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
                           <p class="progress-step-icon">2</p> 
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
        
        <div id="sell-step-3">
            @if(is_null($transaction->tx_id))
            <div class="site-wallet">
                <h3>آدرس ولت Bitcoin:</h3>
                <img src="/assets/wallets/BTC-WALLET.jpg" alt="ولت بیت‌کوین" style="max-width: 200px;">
                <span style="word-break: break-all">{{ $settings['public_btc_wallet']->value }}</span>
                <hr>
                <h3>آدرس ولت Tether:</h3>
                <img src="/assets/wallets/USDT-WALLET.jpg" alt="ولت تتر" style="max-width: 200px;">
                <span style="word-break: break-all">{{ $settings['public_usdt_wallet']->value }}</span>
            </div>
            <hr>
            <div class="txid-wrap">
                <form action="{{ route('User > Transaction > ADD Tx ID', $transaction->hash) }}" method="post" style="text-align: center">
                    @csrf
                    <input type="text" name="tx_id" placeholder="TxID." required>
                    <input type="hidden" name="transaction_id" value="{{ $transaction->hash }}">
                    <br>
                    <button type="submit" class="btn1">ثبت</button>
                </form>
            </div>
            @else
                <div>
                    <p>شناسه زیر برای این پرداخت ثبت شده است:</p>
                    <p style="word-break: break-all; background: #f3f3f3; padding: 0.5%; border: 1px solid green; border-radius: 3px; color: green;">{{ $transaction->tx_id }}</p>
                </div>
            @endif
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
