@extends('user.template')

@section('content')
<!-- section 2 - bread crumbs -->

<div class="uk-container uk-padding">
    <div uk-grid>
        <div class="uk-width-1-2">
            <ul class="uk-breadcrumb">
                <li><a href="{{ route('User > Panel') }}">ناحیه کاربری</a></li>
                <li><a>مدیرت فاکتورها</a></li>
            </ul>
        </div>

        <div class="uk-width-1-2">
            <span class="uk-float-left"><a href="" uk-icon="icon: cloud-download" uk-tooltip="بروزرسانی"></a></span>
        </div>
    </div>
</div>

<!-- section 2 - bread crumbs -->

<!-- section 3 - receipts list -->

<div class="uk-container uk-padding">
    <div class="uk-card uk-card-default uk-card-body uk-border-rounded">
        <div class="uk-card-badge" uk-tooltip="بروزرسانی"><span uk-icon="refresh"></span></div>
        <h2 class="uk-card-title mini-heading"><ion-icon name="wallet-outline"></ion-icon> فاکتورهای من</h2>
        <hr>
        @if($receipts != null && count($receipts))
        <div class="uk-overflow-auto">
            <table class="uk-table uk-table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>تاریخ ایجاد</th>
                        <th>توضیحات</th>
                        <th>قابل پرداخت</th>
                        <th>وضعیت</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>تاریخ ایجاد</th>
                        <th>توضیحات</th>
                        <th>قابل پرداخت</th>
                        <th>وضعیت</th>
                    </tr>
                </tfoot>
                <tbody>
                @foreach($receipts as $receipt)
                    <tr>
                        <th>{{ $receipt->id }}</th>
                        <th>{{ $receipt->created_at }}</th>
                        <th>{{ $receipt->description }}</th>
                        <th>{{ $receipt->payable }}</th>
                        <th>{!! ($receipt->status == 'unpaid') ? '<a href="' . route('User > Receipt > Show', $receipt->id) . '"><span class="uk-text-danger">پرداخت نشده</span></a>' : '<span class="uk-text-success">پرداخت شده</span>' !!}</th>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <hr>
            {{ $receipts->links('vendor.pagination.uikit') }}
        </div>
        @else
        <div class="uk-alert-warning" uk-alert>
            <p>فاکتوری برای شما ثبت نشده است.</p>
        </div>
        @endif
    </div>
</div>

<!-- section 3 - receipts list -->


@endsection
