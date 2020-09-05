@extends('admin.template')

@section('content')
<!-- section 2 - bread crumbs -->

<div class="uk-container uk-padding">
    <div uk-grid>
        <div class="uk-width-1-2">
            <ul class="uk-breadcrumb">
                <li><a href="{{ route('Admin > Dashboard') }}">پنل مدیریت</a></li>
                <li><a href="">تایید کاربران</a></li>
            </ul>
        </div>

        <div class="uk-width-1-2">
            <span class="uk-float-left"><a href="" uk-icon="icon: cloud-download" uk-tooltip="بروزرسانی"></a></span>
        </div>
    </div>
</div>

<!-- section 2 - bread crumbs -->


<!-- section 3 - user list -->

<div class="uk-container uk-padding">
    <div class="uk-card uk-card-default uk-card-body uk-card-hover uk-padding uk-border-rounded">
        <div class="uk-card-badge" uk-tooltip="بروزرسانی"><span uk-icon="refresh"></span></div>
            <h2 class="uk-card-title mini-heading"><ion-icon name="shield-checkmark-outline"></ion-icon> تایید کاربران</h2>
            <hr>

            @if( session('status') )
                @if( session('status') == 'accepted' )
                    <div class="uk-alert-success" uk-alert>
                        <a class="uk-alert-close" uk-close></a>
                        <p>{{ session('message') }}</p>
                    </div>
                @else
                    <div class="uk-alert-danger" uk-alert>
                        <a class="uk-alert-close" uk-close></a>
                        <p>{{ session('message') }}</p>
                    </div>
                @endif
            @endif
            @php
            session()->forget(['status', 'message'])
            @endphp


            @if( count($users) >= 1 )
            <div class="uk-overflow-auto">
                <table class="uk-table uk-table-divider">
                    <thead>
                        <tr>
                            <th>نام</th>
                            <th>ایمیل</th>
                            <th>شماره تلفن</th>
                            <th>شماره ثابت</th>
                            <th>کد ملی</th>
                            <th>آدرس</th>
                            <th>شماره کارت</th>
                            <th>شماره حساب</th>
                            <th>کارت ملی</th>
                            <th>سلفی کارت ملی</th>
                            <th>شناسنامه</th>
                            <th>سلفی شناسنامه</th>
                            <th>عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach( $users->reverse() as $user )
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone_number }}</td>
                            <td>{{ $user->home_number }}</td>
                            <td>{{ $user->national_code }}</td>
                            <td><span uk-tooltip="{{ $user->home_address }}"><span uk-icon="home"></span></span></td>
                            <td>{{ $user->credit_card }}</td>
                            <td>{{ $user->credit_account }}</td>
                            <td>
                                <div uk-lightbox>
                                    <a href="/storage/uploads/certifications/{{ $user->national_card }}">
                                        <img src="/storage/uploads/certifications/{{ $user->national_card }}" alt="" style="max-width: 70px">
                                    </a>
                                </div>
                            </td>
                            <td>
                                <div uk-lightbox>
                                    <a href="/storage/uploads/certifications/{{ $user->person_national_card }}">
                                        <img src="/storage/uploads/certifications/{{ $user->person_national_card }}" alt="" style="max-width: 70px">
                                    </a>
                                </div>
                            </td>
                            <td>
                                <div uk-lightbox>
                                    <a href="/storage/uploads/certifications/{{ $user->birth_certificate }}">
                                        <img src="/storage/uploads/certifications/{{ $user->birth_certificate }}" alt="" style="max-width: 70px">
                                    </a>
                                </div>
                            </td>
                            <td>
                                <div uk-lightbox>
                                    <a href="/storage/uploads/certifications/{{ $user->person_birth_certificate }}">
                                        <img src="/storage/uploads/certifications/{{ $user->person_birth_certificate }}" alt="" style="max-width: 70px">
                                    </a>
                                </div>
                            </td>
                            <td>
                                <!-- This is an anchor toggling the modal -->
                                <a href="#modal-example" uk-toggle>عملیات</a>

                                <!-- This is the modal -->
                                <div id="modal-example" uk-modal>
                                    <div class="uk-modal-dialog uk-modal-body">
                                        <h2 class="uk-modal-title">اعطای دسترسی</h2>
                                        <p>آیا کاربر موردنظر را تایید می‌کنید؟</p>
                                        <form action="{{ route('Admin > Users > Verify Person', $user->id) }}" method="post">
                                            @csrf
                                            <input type="hidden" name="action" value="reject">
                                            <button type="submit" class="uk-button uk-button-danger uk-float-right" type="button">عدم تایید</button>
                                        </form>
                                        <form action="{{ route('Admin > Users > Verify Person', $user->id) }}" method="post">
                                            @csrf
                                            <input type="hidden" name="action" value="accept">
                                            <button type="submit" class="uk-button uk-button-primary uk-float-left" type="button">تایید</button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
            <hr>
            <div>
            {{ $users->links('vendor.pagination.uikit') }}
            </div>
            @else
                <div uk-grid>
                    <div class="uk-width-1-2@m">
                        <img src="https://cdn.dribbble.com/users/1441991/screenshots/4495086/produc-box-anim.gif">
                    </div>
                    <div class="uk-width-1-2@m">
                        <div class="uk-alert-success" uk-alert>
                            <p>درخواستی در سامانه ثبت نشده است.</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- section 3 - user list -->


@endsection
