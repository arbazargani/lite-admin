@extends('user.template')

@section('content')
<div id="workstation">
    <div id="workspace">
        <div class="workspace-wrap">
            <div id="orders-wrap">
                <div class="orders-title">
                    @if( (Auth::check() && Auth::user()->status == 'suspended') || (Auth::check() && Auth::user()->status == 'waiting') || count($alerts) > 0)
                    <div class="alert">
                        <style scoped>
                            div.alert {
                                padding: 2% 3%;
                                background: #d6eff7;
                                border-radius: 10px;
                                margin-bottom: 10px;
                            }
                            ul.alert-list {
                                direction: rtl;
                                text-align: right;
                            }
                        </style>
                        @if(Auth::check() && Auth::user()->status == 'suspended')
                        <ul class="alert-list">
                            <li><p>اکانت شما تایید نشده است. <a href="{{ route('User > Verification') }}">احراز هویت</a></p></li>
                        </ul>
                        @endif
                        @if (Auth::check() && Auth::user()->status == 'waiting')
                        <ul class="alert-list">
                            <li><p>لطفا منتظر تایید مدارک توسط کارشناس سامانه باشید.</p></li>
                        </ul>
                        @endif
                        @if (count($alerts) > 0)
                        <ul class="alert-list">
                            @foreach ($alerts as $alert)
                            <li>
                                <p>
                                {{ $alert->content }}
                                @if($alert->read == 0)
                                <a href="{{ route("Alert > Check", $alert->id) }}"><span class="uk-label uk-label-success uk-float-left"><span uk-icon="check"></span> خوانده شده</span></a>
                                @endif
                                </p>
                            </li>
                            @endforeach
                        </ul>  
                        @endif
                    </div>
                    @endif
                    <h3>پنل کاربری</h3>
                </div>
                <hr>
                <div style="margin-bottom: 95px;">
                    <div style="float: right">
                        <h5>فاکتور‌ها</h5>
                    </div>
                    <div style="float: left">
                        <a href="{{ route('User > Buy Coin') }}"><button class="btn1 info-btn" type="submit">ثبت سفارش</button></a>
                    </div>
                </div>
                <div class="orders-table">
                @if($receipts != null && count($receipts) > 0)
                <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>سفارش</th>
                                <th>مبلغ (تومان)</th>
                                <th>توضیحات</th>
                                <th>وضعیت سفارش</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($receipts as $receipt)
                            <tr>
                                <td>{{ $receipt->id }}</td>
                                <td class="table-cell-cw">
                                     <div class="order-table-user">
                                        <div><p><span></span>{{ $receipt->description }}</p></div>
                                        <div><p><span>تاریخ ایجاد: {{ Facades\Verta::instance($receipt->created_at) }}</span></p></div> 
                                     </div>
                                </td>
                                <td><p>{{ number_format($receipt->payable) }} ت</p></td>
                                <td>
                                    <div class="order-table-info">
                                        <p>تاریخ پرداخت: {{ (!is_null($receipt->paid_at)) ? Facades\Verta::instance($receipt->paid_at) : '-' }}</p>
                                    </div>
                                </td>
                                <td>
                                    <div class="order-table-status" style="direction: rtl; text-align: right">
                                        <p>{!! (!is_null($receipt->paid_at)) ? '<span style="color: green">پرداخت شده</span>' : '<span style="color: red">در انتظار پرداخت</span>' !!}</p>
                                    </div>
                                </td>
                                <td>
                                    @if(is_null($receipt->paid_at))
                                    <form action="{{ route('Payment > Request', $receipt->hash) }}" method="post">
                                        @csrf
                                        <button type="submit" class="button td-btn">پرداخت</button>
                                    </form>
                                    @endif
                                    @if(!is_null($receipt->admin_tx) && $receipt->admin_action == 'accept')
                                    <span>اتمام | <a style="color: green" href="{{ route('User > Receipt > Raw', $receipt->hash) }}">نمایش TX</a></span>
                                    @endif
                                    
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2"></td>
                                <td>‬</td>
                            </tr>
                        </tfoot>
                    </table>
                    @else
                    <p>درخواستی در سامانه ثبت نشده است.</p>
                    @endif
                </div>

                <hr>
                <div style="margin-bottom: 95px;">
                    <div style="float: right">
                        <h5>درخواست‌های فروش</h5>
                    </div>
                    <div style="float: left">
                        <a href="{{ route('User > Sell Coin') }}"><button class="btn1 info-btn" type="submit">ثبت درخواست</button></a>
                    </div>
                </div>
                <div class="orders-table">
                @if($transactions != null && count($transactions) > 0)
                <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>سفارش</th>
                                <th>مبلغ (تومان)</th>
                                <th>TxID</th>
                                <th>وضعیت سفارش</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->id }}</td>
                                <td class="table-cell-cw">
                                     <div class="order-table-user">
                                        <div><p><span></span>{{ $transaction->description }}</p></div>
                                        <div><p><span>تاریخ ایجاد: {{ Facades\Verta::instance($transaction->created_at) }}</span></p></div> 
                                     </div>
                                </td>
                                <td><p>{{ number_format($transaction->payable) }} ت</p></td>
                                <td>
                                    <div class="order-table-info">
                                        @if((!is_null($transaction->tx_id)))
                                        <p><span onclick="window.open('{{ route('User > Transaction > Raw', $transaction->hash) }}','name','width=600,height=400')">نمایش</span></p>
                                        @else
                                        <p><a href="{{ route('User > Transaction > ADD Tx ID', $transaction->hash) }}">ثبت</a></p>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="order-table-status" style="direction: rtl; text-align: right">
                                        @if($transaction->status == 'verified')
                                        <p>{!!  '<span style="color: green">تایید شده</span>' !!}</p>
                                        @elseif($transaction->status == 'rejected')
                                        <p>{!!  '<span style="color: red">درخواست رد شده</span>' !!}</p>
                                        @else
                                        <p>معلق</p>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <p>
                                        @if(!is_null($transaction->tx_id) && !is_null($transaction->pay_tracking_id))
                                            <span onclick="window.open('{{ route('User > Transaction > Tracking ID > Raw', $transaction->hash) }}', 'name','width=600,height=400')">نمایش شناسه پرداخت</span>
                                        @else
                                            <span style="color: red">-</span>
                                        @endif
                                    </p>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2"></td>
                                <td>‬</td>
                            </tr>
                        </tfoot>
                    </table>
                    @else
                    <p>درخواستی در سامانه ثبت نشده است.</p>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
