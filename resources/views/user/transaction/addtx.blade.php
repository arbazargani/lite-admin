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
                <span style="word-break: break-all">1HFrsrcMXDxPV6CjYLFeAaGPKaEAgcksXv</span>
                <hr>
                <h3>آدرس ولت Tether Erc20:</h3>
                <span style="word-break: break-all">0xdd45f252092bfc2aa2fc57dc77118aa5f159c2cc</span>
                <hr>
                <h3>آدرس ولت Tether Trc20:</h3>
                <span style="word-break: break-all">TRSSJ7d4fAcbv1tecUz1QdDcpsrJ8y1Lg6</span>
                <hr>
                <h3>آدرس ولت Zcash:</h3>
                <span style="word-break: break-all">t1XRJzKXJRbvL8P9XL1nJQnc9G7SuWdyWk4</span>
                <hr>
                <h3>آدرس ولت Etherum classic:</h3>
                <span style="word-break: break-all">0xdd45f252092bfc2aa2fc57dc77118aa5f159c2cc</span>
                <hr>
                <h3>آدرس ولت Ravencoin:</h3>
                <span style="word-break: break-all">RS5TKpnAmMQTzJ4mPx8qU8iaBpzZg2M1zu</span>
                <hr>
                <h3>آدرس ولت Etherum:</h3>
                <span style="word-break: break-all">0xdd45f252092bfc2aa2fc57dc77118aa5f159c2cc</span>
                <hr>
                <h3>آدرس ولت Litecoin:</h3>
                <span style="word-break: break-all">Lfj9BtDnViMJaBN2QFkz29s4jjmgSVD3Mj</span>
                <hr>
                <h3>آدرس ولت Tron:</h3>
                <span style="word-break: break-all">TRSSJ7d4fAcbv1tecUz1QdDcpsrJ8y1Lg6</span>
                <hr>
                <h3>آدرس ولت Ripple:</h3>
                <span style="word-break: break-all">rEb8TK3gBgk5auZkwc6sHnwrGVJH8DuaLh</span>
                <hr>
                <h3>آدرس ولت Linkusdt:</h3>
                <span style="word-break: break-all">0xdd45f252092bfc2aa2fc57dc77118aa5f159c2cc</span>
                <hr>
                <h3>آدرس ولت Neo:</h3>
                <span style="word-break: break-all">AVmXA1Uwaz27sHs9qa1vcj2gj9XuEBampf</span>

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
