@extends('user.template')

@section('content')
    <div class="workspace-wrap">
        <div class="sell-wrap">
            <div class="sell-progress-step">
                <ul>
                    <a href="#">
                        <li>
                           <p class="progress-step-icon">1</p>
                           <p class="progress-step-txt">مقدار ارز</p>
                        </li>
                    </a>
                    <i class="fas fa-horizontal-rule"></i>
                    <a href="#">
                        <li>
                           <p class="progress-step-icon">2</p> 
                           <p class="progress-step-txt">تایید فاکتور</p>
                        </li>
                    </a>
                    <i class="fas fa-horizontal-rule"></i>
                    <a href="#">
                        <li>
                            <p class="progress-step-icon">3</p>
                           <p class="progress-step-txt">افزودن TxID</p>
                        </li>
                    </a>
                    <i class="fas fa-horizontal-rule"></i>
                    <a href="#">
                        <li>
                           <p class="progress-step-icon step-icon-active">4</p> 
                           <p class="progress-step-txt">تایید و پرداخت</p>
                        </li>
                    </a>
                </ul>
                <div class="sell-progress-bar-wrap">
                    <div class="sell-progress-bar sell-progress-bar-4"></div>
                </div>
            </div>
        </div>
        <br>
        <div id="sell-step-2">
            @if($transaction->status == 'waiting')
                <p>تراکنش شما ثبت شده و منتظر تایید توسط اپراتور می‌باشد. لطفا در نظر داشته باشید حداقل ۳ تایید باید ثبت شده باشد. پس از تایید نهایی اپراتور انتقال را انجام می دهد و به شما اطلاع رسانی خواهیم کرد.</p>
            @endif
            @if($transaction->status == 'verified')
                <p>تراکنش به تایید کارشناس سامانه رسیداست. اطلاعات این تراکنش به شرح زیر است:</p>
                <div>
                    <p style="word-break: break-all">TxID: <br/> {{ $transaction->tx_id }}</p>
                    <br>
                    <p>مبلغ پرداختی به شما: <br/> {{ number_format($transaction->payable) }}</p>
                    <br>
                    <p>تاریخ پرداخت: <br/> {{ Facades\Verta::instance($transaction->paid_at) }}</p>
                    <br>
                    <p>شناسه پرداخت: <br/> {{ $transaction->pay_tracking_id }}</p>
                </div>
            @endif
        </div>
    </div>
@endsection
