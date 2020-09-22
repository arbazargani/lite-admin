@extends('user.template')

@section('content')
<div id="workstation">
    <div id="workspace">
        <div class="workspace-wrap">
            <div class="orders-title" style="margin-bottom: 100px">
                <div style="float: right">
                    <h3>درخواست‌های فروش</h3>
                </div>
                <div style="float: left">
                    <a href="{{ route('User > Sell Coin') }}"><button class="btn1 info-btn" type="submit">ثبت درخواست</button></a>
                </div>
            </div>
            <div id="orders-wrap">
                <div class="orders-table">
                @if($transactions != null && count($transactions) > 0)
                <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>سفارش</th>
                                <th>مبلغ (تومان)</th>
                                <th>توضیحات</th>
                                <th>TxiD</th>
                                <th>وضعیت سفارش</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td>#{{ $transaction->id }}</td>
                                <td>
                                     <div class="order-table-user">
                                        <div><p><span></span>{{ $transaction->description }}</p></div>
                                        <div><p><span>تاریخ ایجاد: {{ Facades\Verta::instance($transaction->created_at) }}</span></p></div> 
                                     </div>
                                </td>
                                <td><p>{{ number_format($transaction->payable) }} ت</p></td>
                                <td>
                                    <div class="order-table-info">
                                        <p>تاریخ پرداخت: {{ (!is_null($transaction->paid_at)) ? Facades\Verta::instance($transaction->paid_at) : '-' }}</p>
                                    </div>
                                </td>
                                <td>
                                    @php
                                    $exptime = \Carbon\Carbon::parse($transaction->created_at)->addMinutes(20);
                                    $now = \Carbon\Carbon::parse(date("Y-m-d H:i:s"));
                                    @endphp
                                    @if($now > $exptime)
                                        <span>-</span>
                                    @else
                                        @if((!is_null($transaction->tx_id)))
                                        <p><span onclick="window.open('{{ route('User > Transaction > Raw', $transaction->hash) }}','name','width=600,height=400')">نمایش</span></p>
                                        @else
                                        <p><a href="{{ route('User > Transaction > ADD Tx ID', $transaction->hash) }}">ثبت</a></p>
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    <div class="order-table-status" style="direction: rtl; text-align: right">
                                        <p>
                                            @if($transaction->status != 'rejected')
                                                {!! (!is_null($transaction->paid_at) && !is_null($transaction->pay_tracking_id)) ? '<span style="color: green">پرداخت شده</span>' : '<span style="color: red">در انتظار پرداخت</span>' !!}
                                            @else
                                                <span>رد شده</span>
                                            @endif
                                        </p>
                                    </div>
                                </td>
                                <td>
                                    <p>
                                        @php
                                        $exptime = \Carbon\Carbon::parse($transaction->created_at)->addMinutes(20);
                                        $now = \Carbon\Carbon::parse(date("Y-m-d H:i:s"));
                                        @endphp
                                        @if($now > $exptime)
                                            <span style="color: red">اتمام اعتبار درخواست</span>
                                        @else
                                            @if(!is_null($transaction->tx_id) && !is_null($transaction->pay_tracking_id))
                                                <span onclick="window.open('{{ route('User > Transaction > Tracking ID > Raw', $transaction->hash) }}', 'name','width=600,height=400')">نمایش شناسه پرداخت</span>
                                            @else
                                                <span style="color: red">-</span>
                                            @endif
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
                    {{ $transactions->links('vendor.pagination.simple-default') }}
                    @else
                    <p>درخواستی در سامانه ثبت نشده است.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
