@extends('public.template')

@section('content')
	<div class="bg1">
	<!-- Header Start -->
	<div id="header">
		<div id="top-header" style="display: none">
			<div class="top-head-wrap">
				<ul>
					<a href="#">
						<li>BTC/USD 9046.12 $</li>
						<li>ETH/USD 906.02 $</li>
						<li>LTC/USD 9046.12 $</li>
						<li>BCH/USD 2501.12 $</li>
						<li>BTC/USD 9046.12 $</li>
						<li>ETH/USD 110.12 $</li>
					</a>
				</ul>
			</div>
		</div>
		<div id="sub-header">
			<div class="sub-header-div">
				<div class="sub-header-logo">
					<h1><a href="{{ route('Public > Home') }}" style="color: white; font-weight: 100">Cryptiner</a></h1>
				</div>
				<div class="sub-header-nav" id="header-nav">
					<ul>
						<a href="{{ route('User > Panel') }}" class="btn1">
							<li>پنل کاربری</li>
						</a>
						<a href="#">
							<li>قیمت لحظه ای</li>
						</a>
						<a href="#">
							<li>سوالات متداول</li>
						</a>
						<a href="#">
							<li>بلاگ</li>
						</a>
						<a href="#">
							<li>درباره ما</li>
						</a>
						<a href="javascript:void(0);" class="toggle-icon" onclick="nav_toggle()">
							<i class="fa fa-bars"></i>
						</a>
					</ul>
				</div>
			</div>
		</div>
	</div>
	
	<div id="main-section">
		<div class="main-slider clearfix">
			<div class="main-slider-img">
				<img src="/assets/v1/src/img/1.png" alt="main illustrations">
			</div>
			<div class="main-slider-info">
				<div>
					<h2>کریپتاینر</h2>
					<span>خریدی امن با کریپتاینر</span>
					<p>همین حالا حساب کاربری خود را بسازید</p>
					<div class="main-slider-info-action">
						<a href="{{ route('login') }}" class="alt">ورود</a>
						<a href="{{ route('register') }}" >ثبت نام</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
	
<!--	Start Coin Calculating Section	-->
	<div id="coin-cal-section">
		<div class="buy-coin">
			<h3>خرید ارز از ما</h3>
			<div class="coin-select">
				<form>
					<select class="wide" id="buy-currency-in" onchange="makeExchange('buy')">
						<option value="bitcoin">Bitcoin / BTC</option>
						<option value="ethereum">Ethereum / ETH</option>
						<option value="zcash" disabled="">Zcash</option>
						<option value="litecoin">Litecoin / LTC</option>
					</select>
				</form>
			</div>
			<div class="value">
				<form>
					<p>شما پرداخت می کنید:</p>
					<input type="text" id="buy-amount" name="coin-value" placeholder="0.01" onchange="makeExchange('buy')">
					<div>
						<span>{{ number_format($settings['dollar_price_buy']->value) }} Toman</span>
						<span>USD</span>
					</div>
				</form>
			</div>
			<div class="result">
				<form>
					<p>شما دریافت می کنید:</p>
					<p id="buy-tomans" name="coin-value" style="border-bottom: 1px solid; text-align: left; font-size: 2.4rem" readonly><img id="buy-tomans-loader" src="/assets/wallets/ajax-loader.gif" style="width: 18px; vertical-align: sub; display: none"></p>
				</form>
			</div>
		</div>
		<div class="sell-coin">
		<h3>فروش ارز به ما</h3>
			<div class="coin-select">
				<form>
					<select class="wide" id="sell-currency-in" onchange="makeExchange('sell')">
						<option value="bitcoin">Bitcoin / BTC</option>
						<option value="ethereum">Ethereum / ETH</option>
						<option value="zcash" disabled="">Zcash</option>
						<option value="litecoin">Litecoin / LTC</option>
					</select>
				</form>
			</div>
			<div class="value">
				<form>
					<p>شما پرداخت می کنید:</p>
					<input type="text" id="sell-amount" name="coin-value" placeholder="0.01" onchange="makeExchange('sell')">
					<div>
						<span>{{ number_format($settings['dollar_price_sell']->value) }} Toman</span>
						<span>USD</span>
					</div>
				</form>
			</div>
			<div class="result">
				<form>
					<p>شما دریافت می کنید:</p>
					<p id="sell-tomans" name="coin-value" style="border-bottom: 1px solid; text-align: left; font-size: 2.4rem" readonly><img id="sell-tomans-loader" src="/assets/wallets/ajax-loader.gif" style="width: 18px; vertical-align: sub; display: none"></p>
				</form>
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
        function makeExchange(type) {
            if (document.getElementById(type+"-amount").value == "") {
                return;
			}
            if (document.getElementById(type+"-tomans-loader").style.display !== null && document.getElementById(type+"-tomans-loader").style.display !== "inline") {
                document.getElementById(type+"-tomans-loader").style.display = "inline";
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
                        document.getElementById(type+"-tomans-loader").style.display = "none";

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
<!--	End Coin Calculating Section	-->
	<div id="about-us" class="section">
		<div class="section-wrap">
			<div class="section-img">
				<img alt="illustration" src="/assets/v1/src/img/2.jpg" />
			</div>
			<div class="section-txt">
				<h2>ما که هستیم؟</h2>
				<p>بودن یا نبودن؟ مسأله این است! آیا شریفتر آنست که ضربات و لطمات روزگار نامساعد را متحمل شویم و یا آنکه سلاح نبرد بدست گرفته با انبوده مشکلات بجنگیم تا آن ناگواریها را از میان برداریم؟ مردن ... خفتن ... همین وبس؟ اگر خواب مرگ دردهای قلب ما و هزاران آلام دیگر را که طبیعت برجسم ما مستولی می‌کند پایان بخشد، غایتی است که بایستی البته البته آرزومند آن بود. مردن ... خفتن ... خفتن، و شاید خواب دیدن. آه، مانع همین جاست. در آن زمان که این کالبد خاکی را بدور انداخته باشیم، در آن خواب مرگ،‌شاید رویاهای ناگواری ببینیم! ترس از همین رویاهاست که ما را به تأمل وامیدارد و همین گونه ملاحظات است که عمر مصیبت و سختی را اینقدر طولانی می‌کند.
				</p>
				<a href="#"><span class="btn1">بیشتر بدانید</span></a>
			</div>
		</div>
	</div>
	
	<div id="why-us" class="section">
		<div class="section-wrap">
			<div class="section-txt col-alt">
				<h2>چرا ما را انتخاب کنید؟</h2>
				<p>بودن یا نبودن؟ مسأله این است! آیا شریفتر آنست که ضربات و لطمات روزگار نامساعد را متحمل شویم و یا آنکه سلاح نبرد بدست گرفته با انبوده مشکلات بجنگیم تا آن ناگواریها را از میان برداریم؟ مردن ... خفتن ... همین وبس؟ اگر خواب مرگ دردهای قلب ما و هزاران آلام دیگر را که طبیعت برجسم ما مستولی می‌کند پایان بخشد، غایتی است که بایستی البته البته آرزومند آن بود. مردن ... خفتن ... خفتن، و شاید خواب دیدن. آه، مانع همین جاست. در آن زمان که این کالبد خاکی را بدور انداخته باشیم، در آن خواب مرگ،‌شاید رویاهای ناگواری ببینیم! ترس از همین رویاهاست که ما را به تأمل وامیدارد و همین گونه ملاحظات است که عمر مصیبت و سختی را اینقدر طولانی می‌کند.
				</p>
				<a href="#"><span class="btn1">بیشتر بدانید</span></a>
			</div>
			<div class="section-img">
				<img alt="illustration" src="/assets/v1/src/img/3.jpg" />
			</div>
		</div>
	</div>
	
	<div id="feature" class="section bg2">
		<div class="section-wrap">
			<div class="feature-box">
				<div class="feature-box-img"><img alt="Crypto illustration" src="/assets/v1/src/img/i1.jpg" ></div>
				<div class="feature-box-title"><p>خرید و فروش</p></div>
				<div class="feature-box-des"><p>بودن یا نبودن؟ مسأله این است! آیا شریفتر آنست که ضربات و لطمات روزگار نامساعد را متحمل شویم و یا آنکه سلاح نبرد بدست گرفته</p></div>
				<a href="#"><span class="btn1">بیشتر بدانید</span></a>
			</div>
			<div class="feature-box">
				<div class="feature-box-img"><img alt="Crypto illustration" src="/assets/v1/src/img/i2.jpg" ></div>
				<div class="feature-box-title"><p>خرید و فروش</p></div>
				<div class="feature-box-des"><p>بودن یا نبودن؟ مسأله این است! آیا شریفتر آنست که ضربات و لطمات روزگار نامساعد را متحمل شویم و یا آنکه سلاح نبرد بدست گرفته</p></div>
				<a href="#"><span class="btn1">بیشتر بدانید</span></a>
			</div>
			<div class="feature-box">
				<div class="feature-box-img"><img alt="Crypto illustration" src="/assets/v1/src/img/i3.jpg" ></div>
				<div class="feature-box-title"><p>خرید و فروش</p></div>
				<div class="feature-box-des"><p>بودن یا نبودن؟ مسأله این است! آیا شریفتر آنست که ضربات و لطمات روزگار نامساعد را متحمل شویم و یا آنکه سلاح نبرد بدست گرفته</p></div>
				<a href="#"><span class="btn1">بیشتر بدانید</span></a>
			</div>
		</div>
	</div>
	
<!--      Footer      -->
	
	<div id="footer">
		<div class="footer-wrap">
			<div class="footer-sec footer-info">
				<div class="footer-logo">
					<h2>Cryptiner</h2>
				</div>
				<div class="footer-des">
					<p>بودن یا نبودن؟ مسأله این است! آیا شریفتر آنست که ضربات و لطمات روزگار نامساعد را متحمل شویم و یا آنکه سلاح نبرد بدست گرفته</p>
				</div>
			</div>
			<div class="footer-sec footer-nav">
				<ul>
					<a href="#"><li>پنل کاربری</li></a>
					<a href="#"><li>قیمت لحظه ای</li></a>
					<a href="#"><li>سوالات متداول</li></a>
					<a href="#"><li>بلاگ</li></a>
					<a href="#"><li>درباره ما</li></a>
					<a href="#"><li>تماس با ما</li></a>
				</ul>
				<ul>
					<a href="#"><li>پنل کاربری</li></a>
					<a href="#"><li>قیمت لحظه ای</li></a>
					<a href="#"><li>سوالات متداول</li></a>
					<a href="#"><li>بلاگ</li></a>
					<a href="#"><li>درباره ما</li></a>
					<a href="#"><li>تماس با ما</li></a>
				</ul>
				<ul>
					<a href="#"><li>پنل کاربری</li></a>
					<a href="#"><li>قیمت لحظه ای</li></a>
					<a href="#"><li>سوالات متداول</li></a>
					<a href="#"><li>بلاگ</li></a>
					<a href="#"><li>درباره ما</li></a>
					<a href="#"><li>تماس با ما</li></a>
				</ul>
			</div>
			<div class="footer-sec footer-social">
				<div class="social-buttons">
					<a href=""><i class="fab fa-instagram"></i></a>
					<a href=""><i class="fab fa-twitter"></i></a>
					<a href=""><i class="fab fa-telegram-plane"></i></a>
					<a href=""><i class="fab fa-whatsapp"></i></a>
				</div>
			</div>
		</div>
	</div>
@endsection