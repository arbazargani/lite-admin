@extends('user.template')

@section('content')
<!-- section 2 - bread crumbs -->

<div class="uk-container uk-padding">
    <div uk-grid>
        <div class="uk-width-1-2">
            <ul class="uk-breadcrumb">
                <li><a href="{{ route('User > Panel') }}">ناحیه کاربری</a></li>
                <li><a>نمایش فاکتور</a></li>
                <li><a>فاکتور #{{ $receipt->id }}</a></li>
            </ul>
        </div>

        <div class="uk-width-1-2">
            <span class="uk-float-left"><a href="" uk-icon="icon: cloud-download" uk-tooltip="بروزرسانی"></a></span>
        </div>
    </div>
</div>

<!-- section 2 - bread crumbs -->

<!-- section 3 - tranaction request form -->

<div class="uk-container uk-padding">
    <div class="uk-card uk-card-default uk-card-body uk-border-rounded">
        <div uk-grid>
            <div class="uk-width-1-2">
                <h4>فاکتور شماره #{{ $receipt->id }}</h4>
            </div>
            <div class="uk-width-1-2">
                <span>ثبت شده در تاریخ {{ $receipt->created_at }}</span>
            </div>
        </div>
        <hr>
        <div uk-grid>
            <div class="uk-width-1-2">
                <p>توضیحات: <span class="uk-margin-medium-left uk-text-bold">{{ $receipt->description }}</span></p>
            </div>
            <div class="uk-width-1-2">
                <p>قابل پرداخت: <span class="uk-text-bold uk-text-medium">{{ $receipt->payable }} ت</span></p>
            </div>
        </div>
        <hr>
        <div uk-grid>
            <div class="uk-width-1-1">
                <script>
                    function checkForm(form)
                    {
                        if(!form.agree_rules.checked) {
                            window.alert("Please indicate that you accept the Terms and Conditions");
                            form.terms.focus();
                            return false;
                        }
                        return true;
                    }
                </script>
                <form action="{{ route('Payment > Request', $receipt->id) }}" method="post" onsubmit="return checkForm(this);">
                    @csrf
                    <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                        <input class="uk-checkbox" type="checkbox" name="agree_rules" id="agree_rules" required><label for="agree_rules"> قوانین را خوانده و با آنها موافقم.</label>
                    </div>
                    <input type="hidden" name="receipt_id" value="{{ $receipt->id }}">
                    <button class="uk-button uk-button-primary uk-width-1-1" type="submit">پرداخت</button>
                </form>
            </div>
        </div>


    </div>
</div>

<!-- section 3 - tranaction request form -->


@endsection
