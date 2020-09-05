@extends('user.template')

@section('content')


<div id="workstation">
    <div id="workspace">
        <div class="workspace-wrap">
            <div id="orders-wrap">
                <div class="orders-title">
                    <h3>درخواست خرید</h3>
                </div>
                <hr>
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="orders-table">
                    <p><span uk-icon="warning"></span> لطفا در ورود تمامی اطلاعات و صحت آنها دقت نمایید. مسئولیت هرگونه خطای احتمالی با شخص شما خواهد بود.</p>
                    <p><span uk-icon="info"></span> توجه داشته باشید پس از ثبت درخواست، باید از بخش فاکتور ها اقدام به پرداخت نمایید.</p>
                    <hr>
                    <form class="uk-form-horizontal uk-margin-large uk-grid-small" method="post" action="{{ route('User > Receipt > Make') }}" uk-grid>
                        @csrf
                        <div>
                            <div style="width: 40%; padding: 3px; float: right">
                                <p>ارز</p>
                                <div class="sell-coin-select">
                                    <select class="wide" name="coin" id="currency-in">
                                        <option value="bitcoin">Bitcoin / BTC</option>
                                        <option value="ethereum">Ethereum / ETH</option>
                                        <option value="zcash" disabled="">Zcash</option>
                                        <option value="litecoin">Litecoin / LTC</option>
                                    </select>
                                </div>
                            </div>
                            <div style="width: 40%; padding: 3px;">
                                <p>مقدار</p>
                                <input class="uk-input" id="form-horizontal-text" type="text" name="amount" placeholder="مقدار خرید ارز را مشخص نمایید." required>
                            </div>
                            <div style="margin-top: 15px;">
                                <input class="uk-input" id="form-horizontal-text" type="text" name="wallet" placeholder="آدرس ولت خود را به درستی وارد نمایید." required>
                            </div>
                        </div>
                        <div style="margin-top: 35px;">
                            <button class="btn btn1" type="submit">ثبت درخواست</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
