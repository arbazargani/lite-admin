@extends('admin.template')

@section('content')
<div id="workstation">
    <div id="workspace">
        <div id="admin-settings-wrap">
            <div class="admin-settings-right">
                <h3><i class="fad fa-cogs"></i> تنظیمات</h3>
                <div class="admin-settings-nav">
                    <ul>
                        <li class="active"><a href="{{ route('Admin > Settings > Show') }}">تنظیمات سایت</a></li>
                        <li><a href="#">تنظیمات کاربران</a></li>
                        <li><a href="#">تنطیمات محلی</a></li>
                        <li><a href="{{ route('Admin > Settings > Coins') }}">تنظیمات ارزهای سیستم</a></li>
                    </ul>
                </div>
            </div>
            <div class="admin-settings-left">
                <div class="admin-settings-form">
                <form class="user-personal-passwords-form" action="{{ route('Admin > Coins > Add') }}" method="POST">
                    @csrf
                    <label for="name">نام ارز: </label>
                    <input id="name" type="text" name="name" required autocomplete="false">
                    <br>
                    <label for="slug">اسلاگ Binance: </label>
                    <input id="slug" type="text" name="slug" placeholder="***USDT" required autocomplete="false">

                    <button class="btn1 btn" type="submit">بروزرسانی</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
