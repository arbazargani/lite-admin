<!doctype html>
<html dir="rtl" lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>اعلان - کریپتاینر</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.6.17/dist/css/uikit-rtl.min.css">
    <link rel="stylesheet" href="{{ asset('/assets/v3/assets/fonts/iranyekan/css/fontiran.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/v3/assets/fonts/iranyekan/css/style.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.6.17/dist/js/uikit.min.js"></script>
    <style>
        .blob {
            /*background: black;*/
            border-radius: 50%;
            /*margin: 10px;*/
            /*height: 20px;*/
            /*width: 20px;*/

            /*box-shadow: 0 0 0 0 rgba(0, 0, 0, 1);*/
            transform: scale(1);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(0, 0, 0, 0.7);
            }

            70% {
                transform: scale(1);
                box-shadow: 0 0 0 10px rgba(0, 0, 0, 0);
            }

            100% {
                transform: scale(0.95);
                box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
            }
        }
        body {
            background: #a9a9a9;
            height: 100vh;
        }
        #root {
            background: #a9a9a9;
            height: auto;
        }
        * {
            font-family: iranyekan;
        }
        .uk-text-12 {
            font-size: 12px;
        }
        .uk-text-14 {
            font-size: 14px;
        }
        .uk-text-16 {
            font-size: 16px;
        }
        .uk-borderless {
            border-color: #ffffff;
        }
        .uk-borderless:hover {
            border-color: #ffffff;
        }
    </style>
</head>
<?php
    $user = \App\User::find(1);
    $receipt = $user->receipt->skip(1)->first();
    $helper = new \App\Http\Controllers\ActionController;

    $coin = $helper->CoinDictionary("$receipt->selected_coin", 'en', 'fa');
    $amount = $helper->NumberDictionary("$receipt->amount", 'en', 'fa');
    $payable = $helper->NumberDictionary(number_format("$receipt->payable"), 'en', 'fa');
    $date = $helper->NumberDictionary(Facades\Verta::instance($receipt->created_at), 'en', 'fa');
?>
<body>
    <div class="uk-container uk-padding-small" id="root">
        <div class="uk-child-width-expand@s uk-text-center" uk-grid>
            <div>
                <div class="uk-card uk-card-default uk-card-body uk-border-rounded">
                    <!-- header start -->
                    <div class="uk-child-width-expand@s uk-text-right@m" uk-grid>
                        <div>
                            <div class="uk-card uk-card-body">
                                <img src="{{ asset('/assets/v3/src/img/logo-black.png') }}" alt="cryptiner exchange">
                            </div>
                        </div>
                        <div>
                            <div class="uk-card uk-card-body uk-text-left@m">
                                <p class="uk-text-left@m uk-text-16">
                                    <span>تاریخ: {{ explode(' ', $date)[0] }}</span>
                                    <br>
                                    <br>
                                    <span>فاکتور شماره {{ $helper->NumberDictionary($receipt->id) }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- header end -->

                    <div class="uk-divider-small"></div>

                    <!-- content start -->
                    <div class="uk-container">
                        <p class="uk-text-justify uk-text-16">
                            {{ $user->name }} عزیز،  دریافت این ایمیل به معنای ثبت سفارش خرید ارز می‌باشد.
                            <br>
                            <br>
                            جزئیات سفارش شما به شرح زیر است:
                        </p>
                        <table class="uk-table uk-table-middle uk-table-divider uk-text-center uk-text-16">
                            {{--<caption>خرید ارز</caption>--}}
                            <thead>
                            <tr>
                                <th class="uk-text-center">نوع ارز</th>
                                <th class="uk-text-center">مقدار</th>
                                <th class="uk-text-center">قیمت (تومان)</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ $coin }}</td>
                                <td>{{ $amount }}</td>
                                <td>{{ $payable }}</td>
                            </tr>
                            </tbody>
                        </table>
                        <hr>
                        <div class="uk-container uk-width-1-2@m">
                            <table class="uk-table uk-table-middle uk-table-divider uk-text-left uk-text-16">
                                <tbody>
                                <tr>
                                    <td class="uk-table-shrink">مجموع</td>
                                    <td class="uk-table-expand"><span class="uk-label uk-label-success">{{ $payable }} تومان</span></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- content end -->

                    <hr class="uk-divider-small">

                    <!-- cta start -->
                    <div class="uk-text-justify uk-align-center uk-text-16 uk-flex uk-flex-center">
                        <button class="uk-button-secondary uk-border-rounded uk-button-small uk-text-middle"><a class="uk-link-text uk-text-small uk-link-reset" target="_blank" href="{{ route("User > Receipt > Archive") }}">سفارشات شما</a></button>
                        <button class="uk-button-default uk-border-rounded uk-button-small uk-text-middle uk-borderless"><a class="uk-link-text uk-text-small uk-link-reset" target="_blank" href="{{ route("User > Panel") }}">پنل کاربری</a></button>

                    </div>
                    <!-- cta end -->

                    <br>
                    <br>

                    <!-- meta start -->
                    <div class="uk-container">
                        <span class="uk-text-meta">
                            تنها نشانی مورد استفاده کریپتاینر operator@cryptiner.com می‌باشد.
                        </span>
                        <br>
                        <p class="uk-text-meta" style="direction: ltr !important; text-align: center !important;">
                            {{ date("Y/m/d H:i:s") }}
                        </p>

                    </div>
                    <!-- meta end -->
                </div>
            </div>
        </div>
    </div>
</body>
</html>
