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
                            @if (session('error'))
                                <p>{{ session('error') }}</p>
                                @php
                                    session()->forget('error')
                                @endphp
                            @endif
                            <h2>مدیرت ارزها</h2>
                            <br>
                            <style>
                                form {
                                    display: flex;
                                }
                                .minimal-table tr th {
                                    max-width: 45px;
                                }
                                .minimal-btn {
                                    padding: 1px 2px;
                                    border-radius: 2px;
                                    background: green;
                                    font-size: 10px;
                                    color: white;
                                    border: 0px solid lightgray;;
                                }
                                .minimal-input {
                                    padding: 3px !important;
                                    border-radius: 2px !important;
                                    background: rgb(255, 255, 255) !important;
                                    font-size: 13px !important;
                                    color: black !important;
                                    border: 0px solid none !important;
                                    /* max-width: 50px !important; */
                                    height: 32px !important;
                                    font-family: monospace !important
                                }
                                .alerted {
                                    background: rgb(255 102 102 / 50%) !important;
                                }
                                .danger {
                                    background: red;
                                }
                            </style>
                            <div class="workspace-content">
                                <div class="table-wrapper">
                                    <div style="overflow-x: auto !important">
                                        <table class="minimal-table">
                                            <tr>
                                            <th>نام</th>
                                            <th>اسلاگ</th>
                                            <th>قیمت دلار</th>
                                            <th>وضعیت</th>
                                            <th>ولت</th>
                                            </tr>
                                            @foreach ($coins as $coin)
                                            <tr>
                                                <td>{{ $coin->name }}</td>
                                                <td>{{ $coin->slug }}</td>
                                                <td>{{ $coin->usd_price }}</td>
                                                <td>{{ $coin->activate }}</td>
                                                <td>
                                                    <form action="{{ route('Admin > Settings > Wallets') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="coin_id" value="{{ $coin->id }}" class="minimal-input">
                                                        <input type="text" name="wallet_address" value="{{ $coin->wallet_address }}" class="minimal-input">
                                                        <button type="submit" class="minimal-btn danger"><i class="fas fa-check"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
