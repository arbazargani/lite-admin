@extends('admin.template')

@section('content')
    <!-- section 2 - bread crumbs -->

    <div class="uk-container uk-padding">
        <div uk-grid>
            <div class="uk-width-1-2">
                <ul class="uk-breadcrumb">
                    <li><a href="{{ route('Admin > Dashboard') }}">پنل مدیریت</a></li>
                    <li><a href="">فاکتور‌های پرداخت‌شده</a></li>
                </ul>
            </div>

            <div class="uk-width-1-2">
                <span class="uk-float-left"><a href="" uk-icon="icon: cloud-download" uk-tooltip="بروزرسانی"></a></span>
            </div>
        </div>
    </div>

    <!-- section 2 - bread crumbs -->

    <!-- section 3 - receipts series -->

    <div class="uk-container uk-padding">
        <div class="uk-card uk-card-default uk-card-body uk-border-rounded">
        @if($receipts != null && count($receipts) > 0)
            <!-- section - receipts -->
                @foreach($receipts as $receipt)
                    <div class="uk-padding uk-background-muted uk-margin-medium-bottom">
                        <p class="uk-text-meta">#{{ $receipt->id }} | {{ $receipt->user->name }}
                        @if($receipt->admin_action == 'accepted')
                            <span class="uk-float-left uk-text-success">تایید شده</span>
                        @else
                            <span class="uk-float-left uk-text-danger">معلق</span>
                        @endif
                        </p>
                        <hr>
                        <div class="uk-alert-info" uk-alert>
                            <p>{{ $receipt->description }} [  مبلغ پرداخت شده: {{ $receipt->payable }} ت |‌ تاریخ پرداخت:‌ {{ $receipt->paid_at }}  ]</p>
                            <p>شماره تراکنش: {{ $receipt->payment->trans_id }}</p>
                            <hr>
                            <ul uk-accordion>
                                <li>
                                    <a class="uk-accordion-title uk-text-meta" href="#"><span uk-icon="chevron-right"></span> نمایش اطلاعات کاربر</a>
                                    <div class="uk-accordion-content">
                                        <p>آدرس ولت: <span class="uk-text-bolder">{{ $receipt->wallet }}</span></p>
                                        <p>شماره تماس: <span class="uk-text-light">{{ $receipt->user->phone_number }}</span></p>
                                        <p>ایمیل: <span class="uk-text-light">{{ $receipt->user->email }}</span></p>
                                        @if($receipt->admin_action == 'waiting')
                                        <hr>
                                        <div class="uk-child-width-1-2@m" uk-grid>
                                            <div>
                                                <form action="{{ route("Admin > Receipts > Action", $receipt->id) }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="action" value="accepted">
                                                    <button type="submit" class="uk-button uk-button-small uk-button-primary uk-width-1-1">
                                                        <span uk-icon="check"></span> تایید و اتمام انتقال
                                                    </button>
                                                </form>
                                            </div>

                                            <div>
                                                <form action="{{ route("Admin > Receipts > Action", $receipt->id) }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="action" value="rejected">
                                                    <button type="submit" class="uk-button uk-button-small uk-button-danger uk-width-1-1">
                                                        <span uk-icon="close"></span> رد انتقال
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                @endforeach
            <!-- section - receipts -->
            @else
                <div class="uk-alert uk-akert-warning" uk-alert>
                    <p>درخواستی در سامانه ثبت نشده است.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- section 3 - receipts series -->


@endsection
