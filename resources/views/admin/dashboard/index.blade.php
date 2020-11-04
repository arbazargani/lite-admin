@extends('admin.template')

@section('content')
{{--
<div>
    <div class="uk-card uk-card-default uk-card-body flat-sherpa uk-light uk-border-rounded">
        <div class="uk">
            <div class="uk-float-right">
                <a uk-icon="icon: future" onclick="makeExchange()"></a>
            </div>
            <div class="uk-float-left">
                <div style="direction: ltr">

                    <span class="minimal-label">*
                    </span>
                    <input type="number" class="minimal-input" id="currency-number" name="currency-number" min="1" value="1">

                    <span class="minimal-label">From</span>
                    <select class="minimal-select" id="currency-in" name="currency-in">
                        <option value="BTC">BTC</option>
                        <option value="ETH">ETH</option>
                    </select>

                    <span class="minimal-label">To</span>

                    <select class="minimal-select" id="currency-to" name="currency-to">
                        <option value="IRT">IRT</option>
                        <option value="BTC">BTC</option>
                        <option value="ETH">ETH</option>
                    </select>

                    <div id="holder"></div>

                </div>
                <script>
                    function getSelectedCurrency(id) {
                        var e = document.getElementById(id);
                        var value = e.options[e.selectedIndex].value;
                        var text = e.options[e.selectedIndex].text;
                        return value;
                    }
                    function makeExchange() {
                        var from = getSelectedCurrency('currency-in');
                        var to = getSelectedCurrency('currency-to');
                        var number = document.getElementById('currency-number').value;
                        console.log("converting " + number + " from " + from + " to " + to);
                        var xhttp = new XMLHttpRequest();
                        xhttp.onreadystatechange = function() {
                            if (this.readyState == 4 && this.status == 200) {
                                var response = JSON.parse(this.responseText);
                                if (response.ok == true) {
                                    document.getElementById("holder").innerHTML = response.price_to_tomans;
                                    console.log('done: ' + response.price_to_tomans);
                                } else {
                                    document.getElementById("holder").innerHTML = '<code>' + response.error + '<br/>[contact system administrator.]</code>';
                                }
                            }
                        };
                        xhttp.open("POST", "{{ route('CoinExchange') }}?in=" + from + "&to=" + to + "&number=" + number, true);
                        xhttp.send();
                    }
                </script>
            </div>
        </div>
    </div>
</div>
--}}

<div class="workspace-wrap">
    <div id="workstation">
		<div id="workspace">
			<div class="workspace-wrap">
                <div id="orders-wrap">
                    <div class="orders-table has-child">
                        <style scoped>
                            .has-child {
                                text-align: center;
                            }
                            .has-child div {
                                width: 30%;
                                margin: 1%;
                                padding: 2%;
                                border-radius: 7px;
                                display: inline-block;
                                color: white;
                            }
                            .minimal-has-child div {
                                margin: 1%;
                                padding: 2%;
                                border-radius: 7px;
                                display: inline-block;
                                color: white;
                            }

                            .has-child div p {
                                text-align: right;
                                color: white;
                            }
                            .has-child div a {
                                text-align: left !important;
                                float: left;
                                color: white;
                            }
                            .redbg {
                                background: #e74c3c;
                            }
                            .bluebg {
                                background: #3498db;
                            }
                            .orangebg {
                                background: #f1c40f;
                            }
                        </style>
                        
                            <div class="redbg">
                                <p><i class="fal fa-donate" style="font-size: 25px;"></i> فروش روز</p>
                                <a>{{ number_format($today_sells) }}</a>
                            </div>

                            <div class="bluebg">
                                <p><i class="fas fa-receipt" style="font-size: 25px;"></i> فاکتورهای امروز</p>
                                <a>{{ $today_receipts }}</a>
                            </div>

                            <div class="orangebg">
                                <p><i class="fal fa-users" style="font-size: 25px;"></i> کاربران فعال</p>
                                <a>{{ $active_users }}</a>
                            </div>
                        
                    </div>

                    <hr>

                    <div class="orders-table">
                        <h3>وضعیت سامانه</h3>
                        <br>
                        <div>
                            <h5>کاربران</h5>
                            <br>
                            @include('admin.dashboard.charts.users')
                        </div>
                        <div>
                            <h5>رسید‌ها</h5>
                            <br>
                            @include('admin.dashboard.charts.receipts')
                        </div>
                    </div>

                    <hr>
                    
                    <div class="orders-table">
                        <style scoped>
                            div.alert {
                                padding: 2% 3%;
                                background: #d6eff7;
                                border-radius: 10px;
                                margin-bottom: 10px;
                            }
                            ul.info-list {
                                direction: rtl;
                                text-align: right;
                            }
                            .da {
                                padding: 4px;
                                background: #ffcbcb;
                                font-size: 13px;
                            }
                            .ac {
                                padding: 4px;
                                background: #cbffe5;
                                font-size: 13px;
                            }
                            .cp {
                                padding: 4px;
                                background: #ffe5cb;
                                font-size: 13px;
                            }
                        </style>
                        <ul class="info-list">
                            <li><p>ماژول کاربران <span class="ac">فعال</span></p></li>
                            <li><p>ماژول خریدها <span class="ac">فعال</span></p></li>
                            <li><p>ماژول فروش‌ها <span class="ac">فعال</span></p></li>
                            <li><p>ماژول کش <span class="ac">فعال</span></p></li>
                            <li><p>ماژول بلاگ <span class="cp">در حال آماده‌سازی</span></p></li>
                            <li><p>ماژول لاگ <span class="ac">فعال</span></p></li>
                            <li><p>ماژول اکسچنج <span class="da">غیر فعال</span></p></li>
                            <li><p>ماژول تنظیمات <span class="ac">فعال</span></p></li>
                            <li><p>ماژول تیکت <span class="cp">در حال آماده‌سازی</span></p></li>
                        </ul>
                    </div>

                    <hr>

                    <div>
                        <h3>لاگ‌های سیستم</h3>
                        <br>
                        <style>
                            .log-list-wrapper {
                                background: #101416;
                                padding: 3px;
                            }
                            .log-list-wrapper h3{
                                color: white;
                            }
                            .log-list li p {
                                font-family: monospace;
                                font-size: 10px;
                                color:  #52fc03;
                            }
                            .timestamp {
                                background: #f2f2f2;
                                color: #101416;
                            }
                        </style>
                        <div class="log-list-wrapper">
                        <ul class="log-list">
                            @foreach ($logs as $log)
                            <li><p style="direction: ltr; text-align: left">{!! $loop->iteration . '. <span class="timestamp">' . Facades\Verta::instance($log->created_at) . '</span>->' . $log->content !!}</p></li>
                            @endforeach
                        </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
