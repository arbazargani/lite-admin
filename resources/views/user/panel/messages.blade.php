@extends('user.template')

@section('content')
    <!-- section 2 - bread crumbs -->

    <div class="uk-container uk-padding">
        <div uk-grid>
            <div class="uk-width-1-2">
                <ul class="uk-breadcrumb">
                    <li><a href="{{ route('User > Panel') }}">ناحیه کاربری</a></li>
                    <li><a href="">پیام‌های شما</a></li>
                </ul>
            </div>

            <div class="uk-width-1-2">
                <span class="uk-float-left"><a href="" uk-icon="icon: cloud-download" uk-tooltip="بروزرسانی"></a></span>
            </div>
        </div>
    </div>

    <!-- section 2 - bread crumbs -->

    <!-- section 3 - alerts series -->

    <div class="uk-container uk-padding">
        <div class="uk-card uk-card-default uk-card-body uk-border-rounded">
            @if($alerts != null && count($alerts) > 0)
            <!-- section - alerts -->
                @foreach($alerts as $alert)
                    <div class="uk-padding uk-background-muted">
                        <p class="uk-text-meta"><span uk-icon="clock"></span> {{ $alert->created_at }}
                        @if($alert->read == 0)
                        <a href="{{ route("Alert > Check", $alert->id) }}"><span class="uk-label uk-label-success uk-float-left"><span uk-icon="check"></span> خوانده شده</span></a>
                        @else
                        <span class="uk-float-left"><span uk-icon="check"></span> خوانده شده</span>
                        @endif
                        </p>
                        <hr>
                        <div class="uk-alert-{{ $alert->type }}" uk-alert>
                            <p>{{ $alert->content }}</p>
                        </div>
                    </div>
                @endforeach
            <!-- section - alerts -->
            @endif
        </div>
    </div>

    <!-- section 3 - alerts series -->


@endsection
