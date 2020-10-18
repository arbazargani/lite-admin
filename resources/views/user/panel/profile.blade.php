@extends('user.template')

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
                @endif

                @if($user->status == 'suspended')
                    <a class="text-tomato">منتظر ارسال مدارک</a>
                @endif

                @if($user->status == 'verified')
                    <a class="text-tomato">کاربر تایید شده</a>
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
                    <a href="#" class="user-left-box-tab-links" onclick="openCity(event, 'user-personal-passwords')">
                        <li>تغییر رمز عبور</li>
                    </a>
                </ul>
            </div>

            <div id="user-personal-info" class="user-left-box-tabs">
                <form class="user-info-form" action="{{ route('User > Profile > Update') }}" method="POST">
                    @csrf
                    <label for="user-name">نام کامل:</label>
                    <p>{{ $user->name }}</p>

                    <label for="user-mail">ایمیل:</label>
                    <p>{{ $user->email }}</p>

                    <label for="phone_number">شماره موبایل:</label>
                    <p>{!! ($user->phone_number) != NULL ? '<p name="phone_number">' . $user->phone_number . '</p>' : '<input type="text" name="phone_number" placeholder="شماره همراه" id="phone_number" required>' !!}</p>

                    <label for="home_number">شماره ثابت:</label>
                    <p>{!! ($user->home_number) != NULL ? '<p name="home_number">' . $user->home_number . '</p>' : '<input type="text" name="home_number" placeholder="شماره ثابت" id="home_number" required>' !!}</p>
                    
                    <label for="national_code">کد ملی:</label>
                    <p>{!! ($user->national_code) != NULL ? '<p name="national_code">' . $user->national_code . '</p>' : '<input type="text" name="national_code" placeholder="کد ملی" id="national_code" required>' !!}</p>

                    <label for="home_address">آدرس:</label>
                    <input type="text" name="home_address" id="home_address" value="{{ $user->home_address }}">

                    <label for="credit_card">شماره کارت:</label>
                    <input type="text" name="credit_card" id="credit-card" value="{{ $user->credit_card }}">

                    <label for="credit_account">شماره حساب:</label>
                    <input type="text" name="credit_account" id="credit_account" value="{{ $user->credit_account }}">

                    <label for="sheba_account">شماره شبا:</label>
                    <input type="text" name="sheba_account" id="sheba_account" value="{{ $user->sheba_account }}">

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
                    <div class="national-card-doc">
                        <h4>تصویر سلفی کارت ملی</h4>
                        <img src="{{ ($user->person_national_card) != NULL ? '/storage/uploads/certifications/' . $user->person_national_card : '!' }}" alt="">
                        <a {{ ($user->person_national_card) != NULL ? 'href=/storage/uploads/certifications/' . $user->person_national_card : '' }} download><i class="fa fa-cloud-download" aria-hidden="true"></i></a>
                    </div>
                    <div class="national-card-doc">
                        <h4>تصویر سلفی شناسنامه</h4>
                        <img src="{{ ($user->person_birth_certificate) != NULL ? '/storage/uploads/certifications/' . $user->person_birth_certificate : '!' }}" alt="">
                        <a {{ ($user->person_birth_certificate) != NULL ? 'href=/storage/uploads/certifications/' . $user->person_birth_certificate : '' }} download><i class="fa fa-cloud-download" aria-hidden="true"></i></a>
                    </div>
                </div>
            </div>

            <div id="user-personal-transactions" class="user-left-box-tabs">
                <div class="table-wrap">
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

            <div id="user-personal-passwords" class="user-left-box-tabs">
                <form class="user-personal-passwords-form">
                    <label for="user-name">پسورد جدید: </label>
                    <input type="text" name="name" id="user-name">
                    <br>
                    <label for="user-mail">تکرار پسورد جدید: </label>
                    <input type="text" name="email" id="user-mail">
                    <br>
                    <button class="btn1" disabled>ذخیره</button>
                </form>
            </div>
            <!-- docs -->
        </div>

    </div>

</div>
@endsection
