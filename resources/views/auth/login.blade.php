<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title> کریپتو | Crypto </title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link type="text/css" rel="stylesheet" media="all" href="/assets/v2/login.css">
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
</head>
<body>
<div id="main">
    <div class="box-wrap">
        <div class="img-wrap">
            <img src="/assets/v2/src/img/login-slide.jpg" alt="Login Slide" />
        </div>
        <div class="txt-wrap">
            <div class="login-wrap show">
                <h2>ورود به سایت</h2>
                <div class="form-toggle">
                    <div data-type="log" class="active" onclick="toggle_panel(this)">
                        <a href="#">
                            ورود
                        </a>
                    </div>
                    <span></span>
                    <div data-type="reg" onclick="toggle_panel(this)">
                        <a href="#">
                            ثبت نام
                        </a>
                    </div>
                </div>
                <div class="form-wrap">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input type="email" name="email"  class="form-controll" type="text" placeholder="نام کاربری" @error('email') style="border: 1px solid lightred;" @enderror value="{{ old('email') }}" autocomplete="email" required autofocus>
                        @error('email')<strong>{{ $message }}</strong>@enderror

                        <input id="password" name="password" type="password" placeholder="رمز عبور" class="form-control" @error('email') style="border: 1px solid lightred;" @enderror required autocomplete="current-password"> 
                        @error('password')<strong>{{ $message }}</strong>@enderror

                        <div class="remember">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label for="remember">
                                <p>مرا به خاطر بسپار</p>
                            </label>
                        </div>
                        <div class="submit">
                            <button type="submit" class="btn1">ورود به پنل</button>
                        </div>
                    </form>
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
            </div>
            <div class="register-wrap hide">
                <h2>ثبت نام در سایت</h2>
                <div class="form-toggle">
                    <div data-type="log" onclick="toggle_panel(this)">
                        <a href="#">
                            ورود
                        </a>
                    </div>
                    <span></span>
                    <div data-type="reg" class="active" onclick="toggle_panel(this)">
                        <a href="#">
                            ثبت نام
                        </a>
                    </div>
                </div>
                <div class="form-wrap">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <input id="name" name="name" type="text" placeholder="نام و نام خانوادگی" class="form-control" @error('name') style="border: 1px solid lightred;" @enderror value="{{ old('name') }}" required autocomplete="name">
                        @error('name')<strong>{{ $message }}</strong>@enderror

                        <input id="email" name="email" type="email" placeholder="ایمیل" class="form-control" @error('email') style="border: 1px solid lightred;" @enderror value="{{ old('email') }}" required autocomplete="email">
                        @error('email')<strong>{{ $message }}</strong>@enderror

                        <input id="password" name="password" type="password" placeholder="رمز عبور" class="form-control" @error('password') style="border: 1px solid lightred;" @enderror required>
                        @error('password')<strong>{{ $message }}</strong>@enderror

                        <input id="password-confirm" name="password-confirm" type="password" placeholder="تکرار رمز عبور" class="form-control" @error('password-confirm') style="border: 1px solid lightred;" @enderror required>
                        @error('password-confirm')<strong>{{ $message }}</strong>@enderror

                        <div class="submit">
                            <button type="submit" class="btn1">ثبت نام</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
