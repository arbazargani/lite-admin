@extends('user.template')

@section('content')
<div id="workstation">
    <div id="workspace">
        <div class="workspace-wrap">
            <div class="orders-title" style="margin-bottom: 100px">
                <div style="float: right">
                    <h3>درخواست‌های خرید</h3>
                </div>
                <div style="float: left">
                    <a href="{{ route('User > Buy Coin') }}"><button class="btn1 info-btn" type="submit">ثبت سفارش</button></a>
                </div>
            </div>
            <div id="orders-wrap">
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
                                <td>#{{ $receipt->id }}</td>
                                <td>
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
                                    @php
                                        $exptime = \Carbon\Carbon::parse($receipt->created_at)->addMinutes(20);
                                        $now = \Carbon\Carbon::parse(date("Y-m-d H:i:s"));
                                    @endphp
                                    @if($now > $exptime)
                                        @if(is_null($receipt->paid_at))
                                        <span>اتمام اعتبار رسید</span>
                                        @endif
                                        @if(!is_null($receipt->paid_at) && !is_null($receipt->admin_tx) && $receipt->admin_action == 'accept')
                                            <span>اتمام | <a style="color: green" href="{{ route('User > Receipt > Raw', $receipt->hash) }}">نمایش TX</a></span>
                                        @endif
                                    @else
                                        @if(is_null($receipt->paid_at))
                                            <form action="{{ route('Payment > Request', $receipt->id) }}" method="post">
                                                @csrf
                                                <button type="submit" class="button td-btn">پرداخت</button>
                                            </form>
                                        @endif
                                        @if(!is_null($receipt->admin_tx) && $receipt->admin_action == 'accept')
                                            <span>اتمام | <a style="color: green" href="{{ route('User > Receipt > Raw', $receipt->hash) }}">نمایش TX</a></span>
                                        @endif
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
                    {{ $receipts->links('vendor.pagination.simple-default') }}
                    @else
                    <p>درخواستی در سامانه ثبت نشده است.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
