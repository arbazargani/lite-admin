@extends('admin.template')

@section('content')
<div id="workstation">
    <div id="workspace">
        <div class="workspace-wrap">
            <div id="orders-wrap">
                <div class="orders-title">
                    <h3>اعلان‌ها</h3>
                </div>
                @if($alerts != null && count($alerts) > 0)
                @foreach($alerts->reverse() as $alert)
                    <div>
                        <div style="float: right">
                            <i class="fal fa-clock"></i> {{ Facades\Verta::instance($alert->created_at) }}
                        </div>
                        <div style="float: left; display: contents">
                        @if($alert->read == 0)
                            <a href="{{ route("Alert > Check", $alert->id) }}"><span class="uk-label uk-label-success uk-float-left"><span uk-icon="check"></span> خوانده شده</span></a>
                        @else
                            <span class="uk-float-left"><span uk-icon="check"></span> خوانده شده</span>
                        @endif
                        </div>

                        <div class="uk-alert-{{ $alert->type }}" uk-alert>
                            <p>{!! $alert->content !!}</p>
                        </div>
                    </div>
                @endforeach
                <div>
                    {{ $alerts->links('vendor.pagination.simple-default') }}
                </div>
            @else
                <p>اعلانی ثبت نشده است.</p>
            @endif
            </div>
        </div>
    </div>
</div>
@endsection
