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
            @if( session('status') )
                @if( session('status') == 'accepted' )
                        <p>{{ session('message') }}</p>
                @else
                        <p>{{ session('message') }}</p>
                @endif
            @endif
            @php
            session()->forget(['status', 'message'])
            @endphp
            <div id="orders-wrap">
                <div class="orders-title">
                    <h3>درخواست‌های فروش</h3>
                </div>
                <div class="orders-table">
                @if( !is_null($transactions) && count($transactions) >= 1 )
                <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>کاربر</th>
                                <th>توضیحات</th>
                                <th>مبلغ</th>
                                <th>تاریخ ثبت درخواست</th>
                                <th>TX ID</th>
                                <th>شناسه</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach( $transactions as $transaction )
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td><a href="{{ route('Admin > User > Edit', $transaction->user->id) }}" target="_blank">{{ $transaction->user->name }}</a></td>
                            <td>
                                {{ $transaction->description }}
                                <br>
                                <span style="color: blue" onclick="window.open('{{ route('Admin > Users > Raw > Payment Info', $transaction->user->id) }}','name','width=600,height=400')">اطلاعات حساب</span>
                            </td>
                            <td>{{ number_format($transaction->payable) }}</td>
                            <td>{{ Facades\Verta::instance($transaction->created_at) }}</td>
                            <td>
                                <p>
                                    @if(!is_null($transaction->tx_id))
                                        <span onclick="window.open('{{ route('User > Transaction > Raw', $transaction->hash) }}', 'name','width=600,height=400')">نمایش</span>
                                    @else
                                        <span>ثبت نشده</span>
                                    @endif
                                </p>
                            </td>

                            <td>
                                @if ($transaction->status == 'waiting')
                                    <input type="text" name="pay_tracking_id" placeholder="شناسه پرداخت" style="max-width: 160px;" form="accept_form_{{ $transaction->hash }}" required>
                                @else
                                    <span>مجاز نیست</span>
                                @endif

                            </td>
                            <td>
                            @if ($transaction->status == 'waiting')
                                <form action="{{ route('Admin > Transactions > Verify Transaction', $transaction->id) }}" style="display: inline-block; vertical-align: middle;" method="post">
                                    @csrf
                                    <input type="hidden" name="action" value="reject">
                                    <button type="submit" class="button td-btn del-btn" type="button"><i class="fas fa-times"></i></button>
                                </form>
                                <form action="{{ route('Admin > Transactions > Verify Transaction', $transaction->id) }}" style="display: inline-block; vertical-align: middle;" method="post" id="accept_form_{{ $transaction->hash }}">
                                    @csrf
                                    <input type="hidden" name="action" value="accept">
                                    <button type="submit" class="button td-btn" type="button"><i class="fas fa-check"></i></button>
                                </form>
                            @elseif($transaction->status == 'rejected')
                                <span>رد شده</span>
                            @elseif($transaction->status == 'verified')
                                <span>تایید شده</span>
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
                    <hr>
                    <div>
                    {{ $transactions->links('vendor.pagination.simple-default') }}
                    </div>
                    @else
                    <p>درخواستی در سامانه ثبت نشده است.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
