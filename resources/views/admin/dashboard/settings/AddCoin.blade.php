@extends('admin.template')

@section('content')

        <div id="workstation">
            <div id="workspace">
                <div id="admin-settings-wrap">
                    <div class="admin-settings-right">
                        <h3><i class="fad fa-cogs"></i> تنظیمات</h3>
                        <div class="admin-settings-nav">
                            @include('admin.dashboard.settings.options')
                        </div>
                    </div>
                    <div class="admin-settings-left">
                        <div class="admin-settings-form">
                            @if($errors->any())
                                <div class="uk-alert-danger" uk-alert>
                                    @foreach($errors->all() as $error)
                                        <p>- {{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif
                            @if (session('status'))
                                <p>{{ session('status') }}</p>
                                @php
                                    session()->forget('status')
                                @endphp
                            @endif
                            <h2>افزودن ارز</h2>
                            <br>
                            <div class="workspace-content">
                                <div class="table-wrapper">
                                    <div style="overflow-x: auto !important">
                                        <form action="{{ route('Admin > Settings > Coins > Add') }}" method="post">
                                            @csrf
                                            <label>نام ارز:</label>
                                            <input type="text" name="name" id="" value="">

                                            <label>اسلاگ بایننس:</label>
                                            <input type="text" name="slug" id="" value="">
            
                                            <label>موجودی:</label>
                                            <input type="text" name="balance" id="" value="">
            
                                            <label>وضعیت:</label>
                                            <input type="text" name="activate" id="" value="">

                                            <label>آدرس ولت:</label>
                                            <input type="text" name="wallet_address" id="" value="">

                                            <label>حداقل خرید:</label>
                                            <input type="text" name="min_ex_limit" id="" value="">

                                            <label>حداکثر خرید:</label>
                                            <input type="text" name="max_ex_limit" id="" value="">

                                            <br>
                                            <input type="submit" class="btn1" value="ذخیره">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
