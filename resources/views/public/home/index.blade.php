@extends('public.template')

@section('content')
	<div class="bg1">
	<!-- Header Start -->
	<div id="header">
		<div id="top-header">
			<div class="top-head-wrap">
			<style>
				#coinset li img {
					width: 16px;
					vertical-align: middle;
				}
				#coinset li {
					font-family: 'kalameh';
					font-size: 18px;
				}
			</style>
				<ul id='coinset'>
					<a href="#">
						<li>
						<img src="/assets/v3/src/icon/btc.svg" alt="bitcoin">
						@php
							$info = $coins->where('name', 'Bitcoin')->first();
							$dataset = [];
							$dataset[1] = $info->ahead_usd_price_4;
							$dataset[2]= $info->ahead_usd_price_3;
							$dataset[3]= $info->ahead_usd_price_2;
							$dataset[4]= $info->ahead_usd_price_1;
							$dataset[5]= $info->ahead_usd_price;
							$dataset[6]= $info->usd_price;
						@endphp
						<canvas id="Bitcoin_canvas" style="width: 30px !important; height: 10px !important"></canvas>
						<script>
							var chart = new Graph({
								data: [{{ $dataset[1] . ',' . $dataset[2] . ',' . $dataset[3] . ',' . $dataset[4] . ',' . $dataset[5] . ',' . $dataset[6] }}],
								target: document.querySelector('#Bitcoin_canvas'),
								background: "#2e3044",
								lineColor: "#F47E12",
								showCircle: true,
								circle: "#F47E12",
								circleSize: 4,
							});
						</script>
						BTC/USD {{ $coins_usd->where('name', 'Bitcoin')->first()->usd_price }} $
						</li>

						<li>
						<img src="/assets/v3/src/icon/eth.svg" alt="ethereum">
						@php
							$info = $coins->where('name', 'Ethereum')->first();
							$dataset = [];
							$dataset[1] = $info->ahead_usd_price_4;
							$dataset[2]= $info->ahead_usd_price_3;
							$dataset[3]= $info->ahead_usd_price_2;
							$dataset[4]= $info->ahead_usd_price_1;
							$dataset[5]= $info->ahead_usd_price;
							$dataset[6]= $info->usd_price;
						@endphp
						<canvas id="Ethereum_canvas" style="width: 30px !important; height: 10px !important"></canvas>
						<script>
							var chart = new Graph({
								data: [{{ $dataset[1] . ',' . $dataset[2] . ',' . $dataset[3] . ',' . $dataset[4] . ',' . $dataset[5] . ',' . $dataset[6] }}],
								target: document.querySelector('#Ethereum_canvas'),
								background: "#2e3044",
								lineColor: "#5672E6",
								showCircle: true,
								circle: "#5672E6",
								circleSize: 4,
							});
						</script>
						ETH/USD {{ $coins_usd->where('name', 'Ethereum')->first()->usd_price }} $
						</li>

						<li>
						<img src="/assets/v3/src/icon/etc.svg" alt="ethereum">
						@php
							$info = $coins->where('name', 'Ethereum_classic')->first();
							$dataset = [];
							$dataset[1] = $info->ahead_usd_price_4;
							$dataset[2]= $info->ahead_usd_price_3;
							$dataset[3]= $info->ahead_usd_price_2;
							$dataset[4]= $info->ahead_usd_price_1;
							$dataset[5]= $info->ahead_usd_price;
							$dataset[6]= $info->usd_price;
						@endphp
						<canvas id="Ethereum_classic_canvas" style="width: 30px !important; height: 10px !important"></canvas>
						<script>
							var chart = new Graph({
								data: [{{ $dataset[1] . ',' . $dataset[2] . ',' . $dataset[3] . ',' . $dataset[4] . ',' . $dataset[5] . ',' . $dataset[6] }}],
								target: document.querySelector('#Ethereum_classic_canvas'),
								background: "#2e3044",
								lineColor: "#41893A",
								showCircle: true,
								circle: "#41893A",
								circleSize: 4,
							});
						</script>
						ETC/USD {{ $coins_usd->where('name', 'Ethereum_classic')->first()->usd_price }} $
						</li>

						<li>
						<img src="/assets/v3/src/icon/ltc.svg" alt="litecoin">
						@php
							$info = $coins->where('name', 'Litecoin')->first();
							$dataset = [];
							$dataset[1] = $info->ahead_usd_price_4;
							$dataset[2]= $info->ahead_usd_price_3;
							$dataset[3]= $info->ahead_usd_price_2;
							$dataset[4]= $info->ahead_usd_price_1;
							$dataset[5]= $info->ahead_usd_price;
							$dataset[6]= $info->usd_price;
						@endphp
						<canvas id="Litecoin_canvas" style="width: 30px !important; height: 10px !important"></canvas>
						<script>
							var chart = new Graph({
								data: [{{ $dataset[1] . ',' . $dataset[2] . ',' . $dataset[3] . ',' . $dataset[4] . ',' . $dataset[5] . ',' . $dataset[6] }}],
								target: document.querySelector('#Litecoin_canvas'),
								background: "#2e3044",
								lineColor: "#C7C3C3",
								showCircle: true,
								circle: "#C7C3C3",
								circleSize: 4,
							});
						</script>
						LTC/USD {{ $coins_usd->where('name', 'Litecoin')->first()->usd_price }} $
						</li>
						
						<li>
						<img src="/assets/v3/src/icon/zec.svg" alt="zecash">
						@php
							$info = $coins->where('name', 'Zecash')->first();
							$dataset = [];
							$dataset[1] = $info->ahead_usd_price_4;
							$dataset[2]= $info->ahead_usd_price_3;
							$dataset[3]= $info->ahead_usd_price_2;
							$dataset[4]= $info->ahead_usd_price_1;
							$dataset[5]= $info->ahead_usd_price;
							$dataset[6]= $info->usd_price;
						@endphp
						<canvas id="Zecash_canvas" style="width: 30px !important; height: 10px !important"></canvas>
						<script>
							var chart = new Graph({
								data: [{{ $dataset[1] . ',' . $dataset[2] . ',' . $dataset[3] . ',' . $dataset[4] . ',' . $dataset[5] . ',' . $dataset[6] }}],
								target: document.querySelector('#Zecash_canvas'),
								background: "#2e3044",
								lineColor: "#EFBE59",
								showCircle: true,
								circle: "#EFBE59",
								circleSize: 4,
							});
						</script>
						ZEC/USD {{ $coins_usd->where('name', 'Zecash')->first()->usd_price }} $
						</li>
						
						<li>
						<img src="/assets/v3/src/icon/rvn.svg" alt="tether">
						@php
							$info = $coins->where('name', 'Ravencoin')->first();
							$dataset = [];
							$dataset[1] = $info->ahead_usd_price_4;
							$dataset[2]= $info->ahead_usd_price_3;
							$dataset[3]= $info->ahead_usd_price_2;
							$dataset[4]= $info->ahead_usd_price_1;
							$dataset[5]= $info->ahead_usd_price;
							$dataset[6]= $info->usd_price;
						@endphp
						<canvas id="Raven_canvas" style="width: 30px !important; height: 10px !important"></canvas>
						<script>
							var chart = new Graph({
								data: [{{ $dataset[1] . ',' . $dataset[2] . ',' . $dataset[3] . ',' . $dataset[4] . ',' . $dataset[5] . ',' . $dataset[6] }}],
								target: document.querySelector('#Raven_canvas'),
								background: "#2e3044",
								lineColor: "#6c71b8",
								showCircle: true,
								circle: "#6c71b8",
								circleSize: 4,
							});
						</script>
						RVN/USD {{ $coins_usd->where('name', 'Ravencoin')->first()->usd_price }} $
						</li>

						<li>
						<img src="/assets/v3/src/icon/usdt.svg" alt="tether">
						@php
							$info = $coins->where('name', 'Tether')->first();
							$dataset = [];
							$dataset[1] = $info->ahead_usd_price_4;
							$dataset[2]= $info->ahead_usd_price_3;
							$dataset[3]= $info->ahead_usd_price_2;
							$dataset[4]= $info->ahead_usd_price_1;
							$dataset[5]= $info->ahead_usd_price;
							$dataset[6]= $info->usd_price;
						@endphp
						<canvas id="Tether_canvas" style="width: 30px !important; height: 10px !important"></canvas>
						<script>
							var chart = new Graph({
								data: [{{ $dataset[1] . ',' . $dataset[2] . ',' . $dataset[3] . ',' . $dataset[4] . ',' . $dataset[5] . ',' . $dataset[6] }}],
								target: document.querySelector('#Tether_canvas'),
								background: "#2e3044",
								lineColor: "#2EA782",
								showCircle: true,
								circle: "#2EA782",
								circleSize: 4,
							});
						</script>
						USDT/USD {{ $coins_usd->where('name', 'Tether')->first()->usd_price }} $
						</li>
					</a>
				</ul>
			</div>
		</div>
		<div id="sub-header">
			<div class="sub-header-div">
				<div class="sub-header-logo">
					<a href="{{ route('Public > Home') }}"><img src="/assets/v3/src/img/toplogo.png" alt="Cryptiner"></a>
				</div>
				<div class="sub-header-nav" id="header-nav">
					<ul>
						<a href="@if(Auth::check()) {{ (\App\User::find(Auth::id())->rule == 'user') ? route('User > Panel') : route('Admin > Dashboard') }} @else {{ route('login') }} @endif" class="btn1">
							<li>پنل کاربری</li>
						</a>
						<a href="https://shop.cryptiner.com">
							<li>فروشگاه</li>
						</a>
						<a href="http://shop.cryptiner.com/product-category/%d9%85%d8%ad%d8%b5%d9%88%d9%84%d8%a7%d8%aa/%da%a9%d8%a7%d9%86%d8%a7%d9%84-%d9%87%d8%a7%db%8c-%d8%aa%d8%b1%db%8c%d8%af-%d9%88%db%8c%da%98%d9%87/">
							<li>کانال‌های سیگنال</li>
						</a>
						<a href="http://shop.cryptiner.com/product-category/%d9%85%d8%ad%d8%b5%d9%88%d9%84%d8%a7%d8%aa/%d9%85%d8%ad%d8%aa%d9%88%d8%a7%db%8c-%d8%a2%d9%85%d9%88%d8%b2%d8%b4%db%8c/">
							<li>آکادمی</li>
						</a>
						<a href="#">
							<li>مانیتورینگ</li>
						</a>
						<a href="http://shop.cryptiner.com/">
							<li>تعمیرات</li>
						</a>
						<a href="https://blog.cryptiner.com/%d8%aa%d9%85%d8%a7%d8%b3-%d8%a8%d8%a7-%d9%85%d8%a7/">
							<li>تماس با ما</li>
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
				<img src="/assets/v3/src/img/1.png" alt="Bitcoin">
			</div>
			<div class="main-slider-info">
				<div>
					<h2>Cryptiner</h2>
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
						@foreach ($coins as $coin)
						<option value="{{ $coin->slug }}">{{ $coin->name }}</option>
						@endforeach
						{{-- <option value="bitcoin">Bitcoin / BTC</option>
						<option value="ethereum">Ethereum / ETH</option>
						<option value="ethereum-classic">Ethereum Classic</option>
						<option value="ravencoin">Ravencoin</option>
						<option value="zecash">Zcash / ZEC</option>
						<option value="litecoin">Litecoin / LTC</option>
						<option value="tether">Tether / BUSD</option> --}}
					</select>
				</form>
			</div>
			<div class="value">
				<form>
					<p>شما دریافت می کنید:</p>
					<input type="text" id="buy-amount" name="coin-value" placeholder="0.01" onkeyup="setTimeout(makeExchange('buy'), 2000)" autocomplete="off">
					<div>
						<span>{{ number_format($settings->where('name', 'dollar_price_buy')->first()->value) }} Toman</span>
						<span>USD</span>
					</div>
				</form>
			</div>
			<div class="result">
				<form>
					<p>شما پرداخت می کنید:</p>
					<img id="buy-tomans-loader" src="/assets/wallets/ajax-loader.gif" style="width: 18px; vertical-align: sub; display: none"><p id="buy-tomans" name="coin-value" style="border-bottom: 1px solid; text-align: left; font-size: 2.4rem" readonly></p>
				</form>
			</div>
		</div>
		<div class="sell-coin">
		<h3>فروش ارز به ما</h3>
			<div class="coin-select">
				<form>
					<select class="wide" id="sell-currency-in" onchange="makeExchange('sell')">
						@foreach ($coins as $coin)
						<option value="{{ $coin->slug }}">{{ $coin->name }}</option>	
						@endforeach
						{{-- <option value="bitcoin">Bitcoin / BTC</option>
						<option value="ethereum">Ethereum / ETH</option>
						<option value="ethereum-classic">Ethereum Classic</option>
						<option value="ravencoin">Ravencoin</option>
						<option value="zecash">Zcash / ZEC</option>
						<option value="litecoin">Litecoin / LTC</option>
						<option value="tether">Tether / BUSD</option> --}}
					</select>
				</form>
			</div>
			<div class="value">
				<form>
					<p>شما پرداخت می کنید:</p>
					<input type="text" id="sell-amount" name="coin-value" placeholder="0.01" onkeyup="setTimeout(makeExchange('sell'), 2000)" autocomplete="off">
					<div>
						<span>{{ number_format($settings->where('name', 'dollar_price_sell')->first()->value) }} Toman</span>
						<span>USD</span>
					</div>
				</form>
			</div>
			<div class="result">
				<form>
					<p>شما دریافت می کنید:</p>
					<img id="sell-tomans-loader" src="/assets/wallets/ajax-loader.gif" style="width: 18px; vertical-align: sub; display: none"><p id="sell-tomans" name="coin-value" style="border-bottom: 1px solid; text-align: left; font-size: 2.4rem" readonly></p>
				</form>
			</div>
		</div>
		<div style="width: 100%; text-align: center; margin-top: 25px;">
			<span style="font-family: roboto; font-size: 10px; background: #efefef; padding: 10px; border-radius: 5px;">According to <img src="/assets/binance.png" alt="binance" style="width: 3%; vertical-align: middle"></span>
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
			
            if (document.getElementById(type+"-amount").value == "" || DotEnd(type) == true || !isNumber(document.getElementById(type+"-amount").value)) {
				if (document.getElementById(type+"-tomans-loader").style.display !== null) {
					document.getElementById(type+"-tomans-loader").style.display = "none";
				}
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
						console.table(response);

                        console.log('done: ' + response.ok + ':' + response.dollars + ':' + response.tomans);
                    } else {
                        // document.getElementById(type+"-tomans").innerHTML = '<code>' + response.error + '<br/>[contact system administrator.]</code>';
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
				<img alt="illustration" src="/assets/v3/src/img/2.jpg" />
			</div>
			<div class="section-txt">
				<h2>ما که هستیم؟</h2>
				<p>
				کریپتاینر به عنوان یکی از پر سابقه ترین های حوضه ی ارز های دیجیتال با بیش از یک ۵ سال تجربه، انواع امکانات و موارد مورد نیاز در اینکار را در اختیار شما می گذارد و شما به راحتی می توانید قدم به دنیای ارز های دیجیتال بگذارید و با استفاده از ربات های اتوتریدر و کانال های سیگنال و اکادمی اموزشی ما می توانید به راحتی به دنیای زیبای ارز های دیجیتال بپیوندید.
				</p>
				<a href="#"><span class="btn1">بیشتر بدانید</span></a>
			</div>
		</div>
	</div>
	
	<div id="why-us" class="section">
		<div class="section-wrap">
			<div class="section-txt col-alt">
				<h2>شرایط استفاده</h2>
				<p>
				کریپتاینر از ارائه خدمات به اشخاص با هویت پنهان معذور است.
    خدمات وب سایت کریپتاینر مستقل از هر گروه و سازمان می باشد و تابع قوانین جمهوری اسلامی ایران می باشد و از هر گونه خدمات به وب سایت های شرطبندی خودداری می نماید.
    خرید و یا فروش به وب سایت بین 24 الی 72 ساعت به آدرس کیف پول شما و یا حساب ریالی شما ارسال میگردد اما قیمت و مقدار آن قطعی میباشد ...
				</p>
				<a href="#"><span class="btn1">بیشتر بدانید</span></a>
			</div>
			<div class="section-img">
				<img alt="illustration" src="/assets/v3/src/img/3.jpg" />
			</div>
		</div>
	</div>
	
	<div id="feature" class="section bg2">
		<div class="section-wrap">
			<div class="feature-box">
				<div class="feature-box-img"><img alt="Crypto illustration" src="/assets/v3/src/img/i1.jpg" ></div>
				<div class="feature-box-title"><p>آکادمی آموزش</p></div>
				<div class="feature-box-des"><p>برای دیدن بیشتر و ثبت‌نام در کلاس‌های آموزشی از این بخش استفاده نمایید</p></div>
				<a href="http://shop.cryptiner.com/product-category/%d9%85%d8%ad%d8%b5%d9%88%d9%84%d8%a7%d8%aa/%d9%85%d8%ad%d8%aa%d9%88%d8%a7%db%8c-%d8%a2%d9%85%d9%88%d8%b2%d8%b4%db%8c/"><span class="btn1">ورود به آکادمی</span></a>
			</div>
			<div class="feature-box">
				<div class="feature-box-img"><img alt="Crypto illustration" src="/assets/v3/src/img/i3.jpg" ></div>
				<div class="feature-box-title"><p>کانال‌های سیگنال</p></div>
				<div class="feature-box-des"><p>برای دریافت اشتراک VIP کانال سیگنال به لینک زیر مراجعه نمایید.</p></div>
				<a href="http://shop.cryptiner.com/product-category/%d9%85%d8%ad%d8%b5%d9%88%d9%84%d8%a7%d8%aa/%da%a9%d8%a7%d9%86%d8%a7%d9%84-%d9%87%d8%a7%db%8c-%d8%aa%d8%b1%db%8c%d8%af-%d9%88%db%8c%da%98%d9%87/"><span class="btn1">دریافت اشتراک</span></a>
			</div>
			<div class="feature-box">
				<div class="feature-box-img"><img alt="Crypto illustration" src="/assets/v3/src/img/i2.jpg" ></div>
				<div class="feature-box-title"><p>ربات‌های اتوتریدر</p></div>
				<div class="feature-box-des"><p>برای خرید ربات‌های اتوتریدر به بخش زیر مراجعه نمایید.</p></div>
				<a href="http://shop.cryptiner.com/product-category/%d9%85%d8%ad%d8%b5%d9%88%d9%84%d8%a7%d8%aa/%d8%b1%d8%a8%d8%a7%d8%aa-%d9%87%d8%a7/"><span class="btn1">دریافت ربات</span></a>
			</div>
		</div>
	</div>
	
<!--      Footer      -->
	
	<div id="footer">
		<div class="footer-wrap">
			<div class="footer-sec footer-social">
				<div class="social-buttons">
					<a href="https://www.instagram.com/cryptiner_exchange"><i class="fab fa-instagram"></i></a>
					<a href="https://t.me/cryptiner"><i class="fab fa-telegram-plane"></i></a>
					<a href="https://www.youtube.com/channel/UCtxDPgWkv7c-Y0F4V-lUiwg"><i class="fab fa-youtube"></i></a>
					<a href="https://wa.me/989395789200/"><i class="fab fa-whatsapp"></i></a>
					<a href="https://www.aparat.com/cryptiner"><img src="/assets/v3/src/img/aparat.png" style="width: 26.25px; height: 30px; vertical-align: middle; margin-bottom: 10px; filter: brightness(0) invert(1);"></a>
					<a href="http://shop.cryptiner.com"><i class="fas fa-shopping-bag"></i></a>
				</div>
			</div>
			<div class="footer-sec footer-nav">
				<ul>
					<a href="@if(Auth::check()) {{ (\App\User::find(Auth::id())->rule == 'user') ? route('User > Panel') : route('Admin > Dashboard') }} @else {{ route('login') }} @endif"><li>پنل کاربری</li></a>
					<!-- <a href="#"><li>قیمت لحظه ای</li></a> -->
					<a href="#"><li>سوالات متداول</li></a>
					<a href="https://blog.cryptiner.com"><li>بلاگ</li></a>
					<!-- <a href="#"><li>درباره ما</li></a>
					<a href="#"><li>تماس با ما</li></a> -->
				</ul>
				<ul>
					<a href="tel:02122623284"><li>شماره تماس: 22623284</li></a>
					<a href="tel:+989395789200"><li>شماره همراه:‌ 09395789200</li></a>
					<a><li>info@cryptiner.com</li></a>
					<!-- <a href="#"><li>بلاگ</li></a>
					<a href="#"><li>درباره ما</li></a>
					<a href="#"><li>تماس با ما</li></a> -->
				</ul>
			</div>
			<div class="footer-sec footer-info">
				<div class="footer-logo">
					<a href="#"><img alt="footer logo" src="/assets/v3/src/img/toplogo.png" /></a>
				</div>
				<div class="footer-des">
					<p class="des">
					کریپتاینر به عنوان یکی از پر سابقه ترین های حوضه ی ارز های دیجیتال با بیش از یک ۵ سال تجربه، انواع امکانات و موارد مورد نیاز در اینکار را در اختیار شما می گذارد و شما به راحتی می توانید قدم به دنیای ارز های دیجیتال بگذارید و با استفاده از ربات های اتوتریدر و کانال های سیگنال و اکادمی اموزشی ما می توانید به راحتی به دنیای زیبای ارز های دیجیتال بپیوندید.
					</p>
				</div>
			</div>
		</div>
	</div>
@endsection