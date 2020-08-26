@if ($paginator->hasPages())
            <div>
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
            <a style="float: right">@lang('pagination.previous')</a>
            @else
                <a style="float: right" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
            <a style="float: left" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
            @else
            <a style="float: left">@lang('pagination.next')</a>
            @endif
            </div>
@endif
