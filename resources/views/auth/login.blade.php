<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title> کریپتاینر | Cryptiner </title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link type="text/css" rel="stylesheet" media="all" href="/assets/v2/login.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        function toggle_panel(a){
            var data = a.getAttribute("data-type"); 
            var log = document.querySelector(".login-wrap");
            var reg = document.querySelector(".register-wrap");

            if(data === "log"){
                if(log.classList[1] == "hide"){

                    reg.classList.remove("show");
                    reg.classList.add("hide");

                    log.classList.remove("hide");
                    log.classList.add("show");
                }
            }
            if(data === "reg"){
                if(reg.classList[1] == "hide"){
                    log.classList.remove("show");
                    log.classList.add("hide");

                    reg.classList.remove("hide");
                    reg.classList.add("show");
                }
            }
        }
    </script>
    <style>
        .not-valid {
            color: #ef6969;
            font-size: 12px;
            margin: -10px 10px 15px 0px;
        }
        .message-box{
            background: rgba(255, 58, 45 , 0.8);
            max-width: 380px;
            margin: 0px auto; margin-bottom: 20px;
            padding: 20px 40px;
            direction: rtl;

            border-radius: 5px;

            }

            .message-box ul li{
            font-family: "iranyekan";
            font-style: normal;
            font-weight: normal;
            font-size: 14px;
            color: #fefefe;
            }
    </style>
</head>
<body>
<div id="main">
    <div class="box-wrap">
        <div class="img-wrap">
            <img src="/assets/v2/src/img/login-slide.jpg" alt="Login Slide" />
        </div>
        <div class="txt-wrap">
            <div class="login-wrap @if(Request::url() == route('register')) hide @else show @endif">
                <h2>ورود به سایت</h2>
                <div class="form-toggle">
                    <div data-type="log" class="active" onclick="toggle_panel(this)">
                        <a href="#login">
                            ورود
                        </a>
                    </div>
                    <span></span>
                    <div data-type="reg" onclick="toggle_panel(this)">
                        <a href="#register">
                            ثبت نام
                        </a>
                    </div>
                </div>
                <div class="form-wrap">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input type="email" name="email"  class="form-controll" type="text" placeholder="نام کاربری" @error('email') style="border: 1px solid lightred;" @enderror value="{{ old('email') }}" autocomplete="email" required autofocus>
                        @error('email')<p class="not-valid">{{ $message }}</strong><p>@enderror

                        <input id="password" name="password" type="password" placeholder="رمز عبور" class="form-control" @error('email') style="border: 1px solid lightred;" @enderror required autocomplete="current-password"> 
                        @error('password')<p class="not-valid">{{ $message }}</strong><p>@enderror

                        <div class="remember">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">
                                <p>مرا به خاطر بسپار</p>
                            </label>
                        </div>
                        @if(Request::url() == route('login'))
                        <div class="g-recaptcha" id="rcaptcha"  data-sitekey="6LcbDiIaAAAAAKX0hgjlo2Xj9OQybTl9K_KRoYBf"></div>
                        <span id="captcha" style="color:red"></span> <!-- this will show captcha errors -->
                        @endif
                        <div class="submit">
                            <button type="submit" class="btn1">ورود به پنل</button>
                        </div>
                    </form>
                    <div style="text-align: center; margin-top: 7%">
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                    </div>
                </div>
            </div>
            <div class="register-wrap @if(Request::url() == route('login')) hide @else show @endif">
                <h2>ثبت نام در سایت</h2>
                <div class="form-toggle">
                    <div data-type="log" onclick="toggle_panel(this)">
                        <a href="#rlogin">
                            ورود
                        </a>
                    </div>
                    <span></span>
                    <div data-type="reg" class="active" onclick="toggle_panel(this)">
                        <a href="#register">
                            ثبت نام
                        </a>
                    </div>
                </div>
                <div class="form-wrap">
                    @if($errors->all())
                    <div class="message-box show">
                        <ul>
                            <li>رمز عبور نباید کمتر از 8 کاراکتر داشته باشد.</li>
                            <li>رمز عبور باید شامل حروف بزرگ و کوچک باشد.</li>
                        </ul>
                    </div>
                    @endif
                    <form method="POST" action="{{ route('register') }}" id="register_form">
                        @csrf
                        <input id="name" name="name" type="text" placeholder="نام و نام خانوادگی" class="form-control" @error('name') style="border: 1px solid lightred;" @enderror value="{{ old('name') }}" required autocomplete="name">
                        @error('name')<p class="not-valid">{{ $message }}</p>@enderror

                        <input id="email" name="email" type="email" placeholder="ایمیل" class="form-control" @error('email') style="border: 1px solid lightred;" @enderror value="{{ old('email') }}" required autocomplete="email">
                        @error('email')<p class="not-valid">{{ $message }}</p>@enderror

                        <input id="password" name="password" type="password" placeholder="رمز عبور" class="form-control" @error('password') style="border: 1px solid lightred;" @enderror required>
                        @error('password')<p class="not-valid">{{ $message }}</p>@enderror

                        <input id="password_confirm" name="password_confirm" type="password" placeholder="تکرار رمز عبور" class="form-control" @error('password_confirm') style="border: 1px solid lightred;" @enderror required>
                        @error('password_confirm')<p class="not-valid">{{ $message }}</p>@enderror


                        @if(Request::url() == route('register'))
                        <!-- <div class="g-recaptcha" id="rcaptcha"  data-sitekey="6LcbDiIaAAAAAKX0hgjlo2Xj9OQybTl9K_KRoYBf"></div>
                        <span id="captcha" style="color:red"></span> --> <!-- this will show captcha errors -->
                        @endif

                        <div class="submit">
                            <button type="submit" class="btn1 g-recaptcha" data-sitekey="{{ env('recaptcha_invisible_site_key') }}" data-callback='onSubmit'>ثبت‌نام</button>
                            <!-- <button type="submit" class="btn1">ثبت نام</button> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function onSubmit(token) {
        document.getElementById("register_form").submit();
    }
</script>
</body>
</html>
