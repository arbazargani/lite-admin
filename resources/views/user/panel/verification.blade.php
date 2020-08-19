@extends('user.template')

@section('content')
<!-- section 2 - bread crumbs -->

<div class="uk-container uk-padding">
    <div uk-grid>
        <div class="uk-width-1-2">
            <ul class="uk-breadcrumb">
                <li><a href="{{ route('User > Panel') }}">ناحیه کاربری</a></li>
                <li><a href="">ارسال مدارک</a></li>
            </ul>
        </div>

        <div class="uk-width-1-2">
            <span class="uk-float-left"><a href="" uk-icon="icon: cloud-download" uk-tooltip="بروزرسانی"></a></span>
        </div>
    </div>
</div>

<!-- section 2 - bread crumbs -->

@if(Auth::check() && Auth::user()->status == 'suspended')
<!-- section 3 - authentication form -->

<div class="uk-container uk-padding">
    <div class="uk-card uk-card-default uk-card-body uk-card-hover uk-padding uk-border-rounded">
        <div class="uk-card-badge" uk-tooltip="بروزرسانی"><span uk-icon="refresh"></span></div>
        <h2 class="uk-card-title mini-heading"><ion-icon name="cloud-upload-outline"></ion-icon> ارسال مدارک</h2>
        <hr>
        @if($errors->any())
            @foreach($errors->all() as $err)
                {{ $err }}
            @endforeach
        @endif
        <form method="post" action="{{ route('User > Verification') }}" class="uk-form-horizontal uk-margin-large" enctype="multipart/form-data">

            @csrf
            <div class="uk-margin uk-child-width-1-2@m" uk-grid>
            <div class="uk-margin">
                <label class="uk-form-label" for="form-horizontal-text">کارت ملی</label>
                <div class="uk-form-controls">
                    <div class="js-upload uk-placeholder uk-text-center">
                        <span uk-icon="icon: cloud-upload"></span>
                        <span class="uk-text-middle"></span>
                        <div uk-form-custom>
                            <input type="file" name="national_card">
                            <span class="uk-link">انتخاب فایل</span>
                        </div>
                    </div>
                </div>
                @error('national-card')
                <span class="uk-text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="form-horizontal-text">سلفی با کارت ملی</label>
                <div class="uk-form-controls">
                    <div class="js-upload uk-placeholder uk-text-center">
                        <span uk-icon="icon: cloud-upload"></span>
                        <span class="uk-text-middle"></span>
                        <div uk-form-custom>
                            <input type="file" name="person_national_card">
                            <span class="uk-link">انتخاب فایل</span>
                        </div>
                    </div>
                </div>
                @error('person_national_card')
                <span class="uk-text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="form-horizontal-select">شناسنامه</label>
                <div class="uk-form-controls">
                    <div class="js-upload uk-placeholder uk-text-center">
                        <span uk-icon="icon: cloud-upload"></span>
                        <span class="uk-text-middle"></span>
                        <div uk-form-custom>
                            <input type="file" name="birth_certificate">
                            <span class="uk-link">انتخاب فایل</span>
                        </div>
                    </div>
                </div>
                @error('birth-certificate')
                <span class="uk-text-danger uk-text-center">{{ $message }}</span>
                @enderror
            </div>
            <div class="uk-margin">
                <label class="uk-form-label" for="form-horizontal-text">سلفی با شناسنامه</label>
                <div class="uk-form-controls">
                    <div class="js-upload uk-placeholder uk-text-center">
                        <span uk-icon="icon: cloud-upload"></span>
                        <span class="uk-text-middle"></span>
                        <div uk-form-custom>
                            <input type="file" name="person_birth_certificate">
                            <span class="uk-link">انتخاب فایل</span>
                        </div>
                    </div>
                </div>
                @error('person_birth_certificate')
                <span class="uk-text-danger">{{ $message }}</span>
                @enderror
            </div>
            </div>
            <div class="uk-margin uk-child-width-1-2@m" uk-grid>
                <div>
                    <label class="uk-form-label" for="form-horizontal-select">کد ملی</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" name="national_code" type="text" placeholder="0XXXXXXXX">
                    </div>
                </div>
                <div>
                    <label class="uk-form-label" for="form-horizontal-select">تلفن همراه</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" name="phone_number" type="text" placeholder="09XXXXXXXXX">
                    </div>
                </div>
                <div>
                    <label class="uk-form-label" for="form-horizontal-select">تلفن ثابت</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" name="home_number" type="text" placeholder="021-xxxxxxxx">
                    </div>
                </div>
                <div>
                    <label class="uk-form-label" for="form-horizontal-select">آدرس سکونت</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" name="home_address" type="text" placeholder="لطفا با حروف فارسی تایپ کنید.">
                    </div>
                </div>
                <div>
                    <label class="uk-form-label" for="form-horizontal-select">شماره حساب</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" name="credit_account" type="text" placeholder="xxxxxxxxxxxxxxxx">
                    </div>
                </div>
                <div>
                    <label class="uk-form-label" for="form-horizontal-select">شماره کارت</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" name="credit_card" type="text" placeholder="xxx-xxxx-xxxx-xxxx">
                    </div>
                </div>
            </div>

            <div class="uk-margin">
                <div>
                    <button class="uk-float-left uk-button uk-button-primary" type="submit" tabindex="-1">ارسال</button>
                </div>
            </div>

        </form>
    </div>
</div>

<!-- section 3 - authentication form -->
@endif

@if(Auth::check() && Auth::user()->status == 'waiting')
<!-- section 3 - authentication form -->

<div class="uk-container uk-padding">
    <div class="uk-card uk-card-default uk-card-body uk-border-rounded">
        <div class="uk-child-width-1-2@m" uk-grid>
            <div>
                <img src="https://www.marcobehler.com/images/guides/undraw_security_o890-526cc2fb.svg" alt="">
            </div>
            <div>
                <div class="uk-alert-warning" uk-alert>
                    <p>مدارک شما هنوز تایید نشده است. لطفا منتظر بمانید.</p>
                </div>
                <div>
                   <p class="uk-text-meta">در نظر داشته باشید پس از احراز هویت به شما <span class="uk-label">اطلاع رسانی</span> خواهیم کرد.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- section 3 - authentication form -->
@endif

@if(Auth::check() && Auth::user()->status == 'verified')
<!-- section 3 - authentication form -->

<div class="uk-container uk-padding">
    <div class="uk-card uk-card-default uk-card-body uk-border-rounded">
        <div class="uk-child-width-1-2@m" uk-grid>
            <div>
                <img src="https://cdn.dribbble.com/users/2399328/screenshots/5629538/getstarted3_2x.png" alt="">
            </div>
            <div>
                <div class="uk-alert-success" uk-alert>
                    <p>کاربر گرامی مدارک شما تایید شده و می‌توانید از امکانات سیستم استفاده نمایید.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- section 3 - authentication form -->
@endif


@endsection
