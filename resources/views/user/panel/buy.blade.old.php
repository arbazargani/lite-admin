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
                            <p class="progress-step-icon">2</p>
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
                </ul>
                <div class="sell-progress-bar-wrap">
                    <div class="sell-progress-bar sell-progress-bar-1"></div>
                </div>
            </div>
        </div>

        <div id="sell-step-1">
            <div class="sell-tutorial-wrap">
                <h3>راهنمای خرید ارز دیجیتال از سایت</h3>
                <p>
                    1. ابتدا نوع و مقدار ارز مورد نظر خود را برای خرید مشخص کنید.
                    <br>
                    2. سپس میزان دریافتی شما بر حسب قیمت روز ارز مربوطه به شما نمایش داده میشود.
                    <br>
                    3. در صورت تایید شما به مرحله بعد می روید که فاکتور تراکنش شما صادر خواهد شد.
                    <br>
                    4. از بخش فاکتورها اقدام به پرداخت نمایید.
                    <br>
                    5. اپراتور تراکنش شما را تایید خواهد کرد. در این مرحله منتظر انتقال توسط ما شوید.
                    <br>
                    6. در انتها می‌توانید از بخش فروش TxID ثبت شده را ببینید.
                    <hr/>
                    <p style="padding: 4px 10px; border-radius: 3px; background: #ffcbcb; font-size: 13px; font-weight: bold">در نظر داشته باشید مسئولیت ورود اطلاعات اشتباه تماما با شما خواهد بود.</p>
                </p>
            </div>
            <div class="sell-options">
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                @endif
                <div class="sell-options-title">
                    <h3>خرید ارز</h3>
                </div>
                <div class="sell-input">
                    <h4>مقدار</h4>
                    <input form="buy_coin" type="text" name="amount" id="buy-amount" placeholder="0.01" onkeyup="makeExchange('buy')" required>
                </div>
                <div class="sell-coin-select">
                    <form action="{{ route('User > Receipt > Make') }}" method="POST" id="buy_coin">
                        @csrf
                        <select class="wide" name="coin" id="buy-currency-in" onchange="makeExchange('buy')">
                            <option value="bitcoin">Bitcoin / BTC</option>
                            <option value="ethereum">Ethereum / ETH</option>
                            <option value="zecash">Zcash / ZEC</option>
                            <option value="litecoin">Litecoin / LTC</option>
                            <option value="tether">Tether / BUSD</option>
                        </select>
                    </form>
                </div>
                <div class="sale-details-wrap">
                    <div>
                        <span>قیمت دلار: </span>
                        <span>{{ number_format($usd_price->value) }} T</span>
                    </div>
                    <div>
                        <span>قیمت ارز: </span>
                        <span>
                            <span id="dollars"></span>
                                <img id="buy-dollars-loader" src="/assets/wallets/ajax-loader.gif" style="width: 18px; vertical-align: sub; display: none">
                        $</span>
                    </div>
                    <div class="sell-output">
                        <span>مبلغی دریافتی شما: </span>
                        <span>
                            <span id="buy-tomans"></span>
                                <img id="buy-tomans-loader" src="/assets/wallets/ajax-loader.gif" style="width: 18px; vertical-align: sub; display: none">
                        T</span>
                    </div>
                </div>
                <div class="sell-confirm" style="margin-top: 1%">
                    <input form="buy_coin" type="text" name="wallet" id="wallet" placeholder="آدرس ولت" style="width: 100%; margin-bottom: 2%" required>
                    <button form="buy_coin" type="submit" class="btn1">تایید تراکنش</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function getSelectedCurrency(id) {
            var e = document.getElementById(id);
            var value = e.options[e.selectedIndex].value;
			var text = e.options[e.selectedIndex].text;
			console.log(value);
            return value;
        }
		function isNumber(number) {
			return /^-?[\d.]+(?:e-?\d+)?$/.test(number);
		}
		function DotEnd(type) {
			var str = document.getElementById(type+"-amount").value;
			return str.endsWith(".");
		}
        function makeExchange(type) {
			
            if (document.getElementById(type+"-amount").value == "" || DotEnd(type) || !isNumber(document.getElementById(type+"-amount").value)) {
                return;
			}
			
            if (document.getElementById(type+"-tomans-loader").style.display !== null && document.getElementById(type+"-tomans-loader").style.display !== "inline") {
                document.getElementById(type+"-tomans-loader").style.display = "inline";
                document.getElementById(type+"-dollars-loader").style.display = "inline";
            }
            var from = getSelectedCurrency(type+'-currency-in');
            var number = document.getElementById(type+'-amount').value;
            console.log("converting " + number + " from " + from + " to USD");
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var response = JSON.parse(this.responseText);
                    if (response.ok == true) {
                        document.getElementById(type+"-tomans").innerHTML = response.tomans;
                        document.getElementById("dollars").innerHTML = response.dollars;
                        document.getElementById(type+"-tomans-loader").style.display = "none";
                        document.getElementById(type+"-dollars-loader").style.display = "none";

                        console.log('done: ' + response.ok + ':' + response.dollars + ':' + response.tomans);
                    } else {
                        document.getElementById(type+"-tomans").innerHTML = '<code>' + response.error + '<br/>[contact system administrator.]</code>';
                    }
                }
			};
			if (type == 'buy') {
				xhttp.open("GET", "{{ route('CoinExchangeBuy') }}?currency-in=" + from + "&amount=" + number, true);
			}
			if (type == 'sell') {
				xhttp.open("GET", "{{ route('CoinExchange') }}?currency-in=" + from + "&amount=" + number, true);
			}
            
            xhttp.send();
        }
    </script>
@endsection