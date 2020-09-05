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
                                <th>وضعیت</th>
                                <th>عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach( $transactions->reverse() as $transaction )
                        <tr>
                            <td>{{ $transaction->id }}</td>
                            <td>{!! $transaction->user->status == 'verified' ? 'y' : 'n' !!} {{ $transaction->user->name }}</td>
                            <td>{{ $transaction->description }}</td>
                            <td>{{ number_format($transaction->payable) }}</td>
                            <td>{{ Facades\Verta::instance($transaction->created_at) }}</td>
                            <td>
                                <p>{!! (!is_null($transaction->tx_id)) ? '<a href="' . route('User > Transaction > Raw', $transaction->hash) . '">نمایش</a>' : '<a href="' . route('User > Transaction > Show', $transaction->hash) . '">ثبت</a>' !!}</p>
                            </td>
                            <td>{{ $transaction->status }}</td>
                            <td>
                            <form action="{{ route('Admin > Transactions > Verify Transaction', $transaction->id) }}" style="display: inline-block; vertical-align: middle;" method="post">
                                @csrf
                                <input type="hidden" name="action" value="reject">
                                <button type="submit" class="button td-btn del-btn" type="button"><i class="fas fa-times"></i></button>
                            </form>
                            <form action="{{ route('Admin > Transactions > Verify Transaction', $transaction->id) }}" style="display: inline-block; vertical-align: middle;" method="post">
                                @csrf
                                <input type="hidden" name="action" value="accept">
                                <button type="submit" class="button td-btn" type="button"><i class="fas fa-check"></i></button>
                            </form>
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
