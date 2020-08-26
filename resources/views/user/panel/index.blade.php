@extends('user.template')

@section('content')
<div id="workstation">
    <div id="workspace">
        <div class="workspace-wrap">
            <div id="orders-wrap">
                <div class="orders-title">
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
                                    @if(is_null($receipt->paid_at))
                                    <form action="{{ route('Payment > Request', $receipt->id) }}" method="post">
                                        @csrf
                                        <button type="submit" class="button td-btn">پرداخت</button>
                                    </form>
                                    @elseif(!is_null($receipt->admin_tx) && $receipt->admin_action == 'accept')
                                    
                                    <span>اتمام | <a style="color: green" href="{{ route('User > Receipt > Raw', $receipt->id) }}">نمایش TX</a></span>

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
            </div>
        </div>
    </div>
</div>
@endsection
