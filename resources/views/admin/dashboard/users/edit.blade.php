@extends('admin.template')

@section('content')
<div class="workspace-wrap">

    <div class="user-edit-wrap">

        <div class="user-right-box dash-box">
            <div class="user-info-pic">
                <img src="https://i1.sndcdn.com/avatars-000289622160-xnbwqi-t500x500.jpg" alt="User Image">
            </div>
            <div class="user-info-txt">
                <h3>{{ $user->name }}</h3>
                <p>{{ $user->email }}</p>
            </div>
            <div class="user-approve">
                @if($user->status == 'waiting')
                    <a class="text-tomato">در انتظار تایید</a>
                    <form action="{{ route('Admin > Users > Quick Verify Person', $user->id) }}" method="POST" style="display: inline-block">
                        @csrf
                        <button class="btn1 info-btn" type="submit">تایید کاربر</button>
                    </form>
                @endif

                @if($user->status == 'suspended')
                    <a class="text-tomato">منتظر ارسال مدارک</a>
                @endif

                @if($user->status == 'verified')
                        <a class="text-tomato">کاربر تایید شده</a>
                        <form action="{{ route('Admin > Users > Block User', $user->id) }}" method="POST" style="display: inline-block">
                            @csrf
                            <button class="btn1 danger-btn" type="submit">بلاک</button>
                        </form>
                @endif
            </div>
            <div class="user-transactions">
                <p><i class="fa fa-credit-card"></i> تعداد تراکنش: {{ $transactions_count }}</p>
                <p><i class="fa fa-id-card"></i> کد ملی: {{ $user->national_code }}</p>
            </div>
        </div>

        <div class="user-left-box">
            <div class="user-left-box-title">
                <ul>
                    <a href="#" class="user-left-box-tab-links" onclick="openCity(event, 'user-personal-info')">
                        <li>مشخصات شخصی</li>
                    </a>
                    <a href="#" class="user-left-box-tab-links" onclick="openCity(event, 'user-personal-docs')">
                        <li>مدارک ارسالی</li>
                    </a>
                    <a href="#" class="user-left-box-tab-links" onclick="openCity(event, 'user-personal-transactions')">
                        <li>تراکنش ها</li>
                    </a>
                    <a href="#" class="user-left-box-tab-links" onclick="openCity(event, 'user-message')">
                        <li>ارسال پیام خصوصی</li>
                    </a>
                    <a href="#" class="user-left-box-tab-links" onclick="openCity(event, 'user-personal-passwords')">
                        <li>تغییر رمز عبور</li>
                    </a>
                </ul>
            </div>

            <div id="user-personal-info" class="user-left-box-tabs">
                <form class="user-info-form" action="{{ route('Admin > User > Update', $user->id) }}" method="POST">
                    @csrf
                    <label for="user-name">نام کامل:</label>
{{--                    <input type="text" name="name" id="user-name">--}}
                    <p>{{ $user->name }}</p>
                    <label for="user-mail">ایمیل:</label>
{{--                    <input type="text" name="email" id="user-mail">--}}
                    <p>{{ $user->email }}</p>
                    <label for="user-mail">شماره موبایل:</label>
{{--                    <input type="text" name="phone-number" id="user-phone-number">--}}
                    <p>{!! ($user->phone_number) != NULL ? $user->phone_number : '<span class="text-tomato">ثبت نشده</span>' !!}</p>
                    <label for="user-mail">شماره ثابت:</label>
{{--                    <input type="text" name="static-number" id="user-static-number">--}}
                    <p>{!! ($user->phone_number) != NULL ? $user->phone_number : '<span class="text-tomato">ثبت نشده</span>' !!}</p>
                    <label for="user-mail">کد ملی:</label>
{{--                    <input type="text" name="nat-code" id="user-nat-code">--}}
                    <p>{!! ($user->national_code) != NULL ? $user->national_code : '<span class="text-tomato">ثبت نشده</span>' !!}</p>
                    <label for="user-mail">آدرس:</label>
                    <input type="text" name="home_address" id="user-address" value="{{ $user->home_address }}">
                    <label for="user-mail">شماره کارت:</label>
                    <input type="text" name="credit_card" id="user-credit-card-number" value="{{ $user->credit_card }}">
                    <label for="user-mail">شماره حساب:</label>
                    <input type="text" name="credit_account" id="user-credit-account" value="{{ $user->credit_account }}">
                    <hr>
                    <button class="btn1 btn" type="submit">بروزرسانی</button>
                </form>
            </div>

            <div id="user-personal-docs" class="user-left-box-tabs">
                <div class="user-docs">
                    <div class="national-card-doc">
                        <h4>تصویر کارت ملی</h4>
                        <img src="{{ ($user->national_card) != NULL ? '/storage/uploads/certifications/' . $user->national_card : '!' }}" alt="">
                        <a {{ ($user->national_card) != NULL ? 'href=/storage/uploads/certifications/' . $user->national_card : '' }} download><i class="fa fa-cloud-download" aria-hidden="true"></i></a>
                    </div>
                    <div class="national-card-doc">
                        <h4>تصویر شناسنامه</h4>
                        <img src="{{ ($user->birth_certificate) != NULL ? '/storage/uploads/certifications/' . $user->birth_certificate : '!' }}" alt="">
                        <a {{ ($user->birth_certificate) != NULL ? 'href=/storage/uploads/certifications/' . $user->birth_certificate : '' }} download><i class="fa fa-cloud-download" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>

            <div id="user-personal-transactions" class="user-left-box-tabs">
                <div class="table-wrapper">
                    @if(count($latest_transactions) > 0)
                        <table>
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>توضیحات</th>
                                <th>وضعیت</th>
                                <th>مبلغ</th>
                                <th>تاریخ پرداخت</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($latest_transactions as $transaction)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $transaction->description }}</td>
                                <td>{{ $transaction->status }}</td>
                                <td>{{ $transaction->payable }}</td>
                                <td>تایید شده</td>
                                <td>{{ $transaction->piad_at }}</td>
                                <td>
                                    <a class="button td-btn">ویرایش</a>
                                    <a class="button td-btn del-btn">حذف</a>
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
                    <p>تراکنشی در سیستم ایجاد نشده است.</p>
                    @endif
                </div>
            </div>

            <div id="user-message" class="user-left-box-tabs">
                <style>
                    #content > div.fr-wrapper > div p {
                        direction: rtl;
                    }
                </style>
                <form action="{{ route('Admin > Messages > Unicast', $user->id) }}" method="POST">
                    @csrf
                    <textarea id="content" name="content"></textarea>
                    <br>
                    <button class="btn1 info-btn" type="submit">ارسال پیام</button>
                </form>
               
               <script>
                   var editor = new FroalaEditor('#null', {
                        toolbarButtons: {
                            'moreParagraph': {
                                'buttons': ['bold', 'italic', 'underline', 'createLink', 'alignLeft', 'alignCenter', 'alignRight', 'formatOLSimple', 'alignJustify', 'formatOL', 'formatUL', 'paragraphFormat', 'paragraphStyle', 'lineHeight', 'outdent', 'indent', 'quote', 'insertLink']
                            }
                        },
                        direction: 'rtl',
                        theme: 'dark',
                        align: 'right',
                        placeholderText: 'ارسال پیام شخصی به کاربر'
                   });
               </script>
            </div>
            
            <div id="user-personal-passwords" class="user-left-box-tabs">
                <form class="user-personal-passwords-form" action="{{ route('password.update') }}" method="POST">
                    <label for="password">پسورد جدید: </label>
                    <input id="password" type="password" name="password" required autocomplete="false">
                    <br>
                    <label for="password-confirm">تکرار پسورد جدید: </label>
                    <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="false">
                    <button class="btn1 btn" type="submit">بروزرسانی</button>
                </form>
            </div>
            <!-- docs -->
        </div>

    </div>

</div>
@endsection
