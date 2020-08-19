@extends('admin.template')

@section('content')
<!-- section 2 - bread crumbs -->

<div class="uk-container uk-padding">
    <div uk-grid>
        <div class="uk-width-1-2">
            <ul class="uk-breadcrumb">
                <li><a href="{{ route('Admin > Dashboard') }}">پنل مدیریت</a></li>
                <li><a href="">مدیریت تراکنش‌ها</a></li>
            </ul>
        </div>

        <div class="uk-width-1-2">
            <span class="uk-float-left"><a href="" uk-icon="icon: cloud-download" uk-tooltip="بروزرسانی"></a></span>
        </div>
    </div>
</div>

<!-- section 2 - bread crumbs -->


<!-- section 3 - user list -->

<div class="uk-container uk-padding">
    <div class="uk-card uk-card-default uk-card-body uk-card-hover uk-padding uk-border-rounded">
        <div class="uk-card-badge" uk-tooltip="بروزرسانی"><span uk-icon="refresh"></span></div>
            <h2 class="uk-card-title mini-heading"><ion-icon name="card-outline"></ion-icon> تایید انتقالات</h2>
            <hr>

            @if( session('status') )
                @if( session('status') == 'accepted' )
                    <div class="uk-alert-success" uk-alert>
                        <a class="uk-alert-close" uk-close></a>
                        <p>{{ session('message') }}</p>
                    </div>
                @else
                    <div class="uk-alert-danger" uk-alert>
                        <a class="uk-alert-close" uk-close></a>
                        <p>{{ session('message') }}</p>
                    </div>
                @endif
            @endif
            @php
            session()->forget(['status', 'message'])
            @endphp


            @if( count($transactions) >= 1 )
            <div class="uk-overflow-auto">
                <table class="uk-table uk-table-divider">
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
                            <td>{{ $transaction->user->name }}</td>
                            <td>{{ $transaction->description }}</td>
                            <td>{{ $transaction->payable }}</td>
                            <td>{{ $transaction->created_at }}</td>
                            <td><p>{{ $transaction->tx_id }}</p></td>
                            <td>{{ $transaction->status }}</td>
                            <td>
                                <!-- This is an anchor toggling the modal -->
                                <a href="#modal-example" uk-toggle>عملیات</a>

                                <!-- This is the modal -->
                                <div id="modal-example" uk-modal>
                                    <div class="uk-modal-dialog uk-modal-body">
                                        <h2 class="uk-modal-title">تایید تراکنش</h2>
                                        <p>آیا تراکنش موردنظرتان تایید شده است؟</p>
                                        <form action="{{ route('Admin > Transactions > Verify Transaction', $transaction->id) }}" method="post">
                                            @csrf
                                            <input type="hidden" name="action" value="reject">
                                            <button type="submit" class="uk-button uk-button-danger uk-float-right" type="button">عدم تایید</button>
                                        </form>
                                        <form action="{{ route('Admin > Transactions > Verify Transaction', $transaction->id) }}" method="post">
                                            @csrf
                                            <input type="hidden" name="action" value="accept">
                                            <button type="submit" class="uk-button uk-button-primary uk-float-left" type="button">تایید</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
            <hr>
            <div>
            {{ $transactions->links('vendor.pagination.uikit') }}
            </div>
            @else
                <div class="" uk-grid>
                    <div>
                        <img src="https://cdn.dribbble.com/users/1441991/screenshots/4495086/produc-box-anim.gif" style="max-width: 370px" alt="">
                    </div>
                    <div class="uk-width-expand">
                        <div class="uk-alert-success" uk-alert>
                            <p>درخواستی در سامانه ثبت نشده است.</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- section 3 - user list -->


@endsection
