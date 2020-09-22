@extends('admin.template')

@section('content')
<div class="workspace-wrap">
    <div class="workspace-title">
        <h3>کاربران</h3>
    </div>
    <div class="workspace-content">
        <div class="table-wrap">
            @if(count($users) > 0)
                <table>
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>نام کاربر</th>
                        <th>ایمیل کاربر</th>
                        <th>تلفن</th>
                        <th>کد ملی</th>
                        <th>وضعیت تایید</th>
                        <th>عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone_number }}</td>
                            <td>{{ $user->national_code }}</td>
                            <td>
                            @if($user->status == 'suspended')
                                <span style="color: gray">محدود</span>
                            @endif
                            @if($user->status == 'waiting')
                            <span style="color: orange">در انتظار تایید</span>
                            @endif
                            @if($user->status == 'verified')
                                <span style="color: green">تایید شده</span>
                            @endif
                            </td>
                            <td>
                                @if($user->rule != 'admin' && $user->rule != 'root')

                                    <a class="button td-btn" href="{{ route('Admin > User > Edit', $user->id) }}">ویرایش</a>

                                    @if($user->status == 'verified')

                                    <form action="{{ route('Admin > Users > Block User', $user->id) }}" method="post" style="display: inline-block">
                                        @csrf
                                        <button class="button td-btn del-btn">بلاک</button>
                                    </form>

                                    @endif

                                @else

                                <span>عملیات برای مدیر مجاز نیست.</span>

                                @endif
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
                <div>
                    ‬{!! $users->links('vendor.pagination.simple-default') !!}
                </div>
            @else
                <p>کاربری در سامانه موجود نیست.</p>
            @endif
        </div>
    </div>
    </div>
@endsection
