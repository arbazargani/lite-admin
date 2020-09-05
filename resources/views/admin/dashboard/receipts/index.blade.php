@extends('admin.template')

@section('content')
<style>
    .nice-select {
        width: 100% !important;
        text-align: right !important;
        direction: rtl !important;
        height: min-content;
        margin-bottom: 4px;
    }
</style>
    <div id="workstation">
		<div id="workspace">
			<div class="workspace-wrap">
                <div id="orders-wrap">
                    <div class="orders-title">
                        <h3>سفارشات</h3>
                    </div>
                    <div class="orders-table">
                    @if($receipts != null && count($receipts) > 0)
                    <table>
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>کاربر</th>
                                    <th>سفارش</th>
                                    <th>مبلغ (تومان)</th>
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
                                             <p>{{ $receipt->user->name }}</p>
                                             <p>{{ $receipt->user->email }}</p>
                                             <p>{!! ($receipt->user->status == 'verified') ? '<span style="color: green">تایید شده</span>' : '<span style="color: red">در انتظار تایید</span>' !!}</p>
                                         </div>
                                    </td>
                                    <td>
                                        <div class="order-table-info">
                                            <div><p><span></span>{{ $receipt->description }}</p></div>
                                            <!-- <div><p><span>قیمت هر واحد: </span>11,580 USD</p></div> -->
                                            <!-- <div><p><span>معادل: </span>74.78 USD</p></div> -->
                                            <!-- <div><p><span>نرخ ارز: </span>23,880 Toman</p></div> -->
                                            <div><p><span>تاریخ ایجاد: {{ Facades\Verta::instance($receipt->created_at) }}</span></p></div>
                                        </div>
                                    </td>
                                    <td><p>{{ number_format($receipt->payable) }} ت</p></td>
                                    <td>
                                        <div class="order-table-status" style="direction: rtl; text-align: right">
                                            <p>وضعیت سفارش: {{ is_null($receipt->admin_tx) ? 'در حال انجام' : 'انجام شده' }}</p>
                                            <p>وضعیت پرداخت: {!! (!is_null($receipt->paid_at)) ? '<span style="color: green">پرداخت شده</span>' : '<span style="color: red; font-weight: 800">در انتظار پرداخت</span>' !!}</p>
                                            <p>تاریخ پرداخت: {{ (!is_null($receipt->paid_at)) ? Facades\Verta::instance($receipt->paid_at) : '-' }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        @if(is_null($receipt->admin_tx))
                                        <form action="{{ route('Admin > Receipts > Action', $receipt->id) }}" method="POST">
                                            @csrf
                                            <select name="admin_action" id>
                                                <option value="accept">تایید</option>
                                                <option value="reject">عدم تایید</option>
                                            </select>
                                            <input type="text" name="tx_id" placeholder="tx_id">
                                            <button class="button td-btn" style="width: auto" type="submit">افزودن TX_ID</button>
                                        </form>
                                        @else
                                        <span>اتمام | <span style="color: green" onclick="window.open('{{ route('User > Receipt > Raw', $receipt->hash) }}','name','width=600,height=400')">نمایش TX</span></span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="2"></td>
                                </tr>
                            </tfoot>
                        </table>
                        <script>MicroModal.init();</script>
                        ‬{!! $receipts->links('vendor.pagination.simple-default') !!}
                        @else
                        <p>درخواستی در سامانه ثبت نشده است.</p>
                        @endif
                    </div>
                </div>
			</div>
		</div>
    </div>
@endsection
