<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    {{-- Meta Tags --}}
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> {{ env('APP_NAME') }} </title>

    {{-- Assets and styles --}}
    <link type="text/css" rel="stylesheet" media="all" href="/assets/v2/style.css">

    <!--Font Awsome-->
    <link href="/assets/v2/assets/fonts/fontawesome-pro/css/all.css" rel="stylesheet">
    <script defer src="/assets/v2/assets/fonts/fontawesome-pro/js/all.js"></script>

    <!--CryptoFont-->
    <link href="/assets/v2/assets/fonts/cryptofont-1.2.0/cryptofont.css" rel="stylesheet">

    <!--jQuery Nice Select-->
    <script src="/assets/v2/assets/js/jquery-nice-select-1.1.0/js/jquery.js"></script>
    <script src="/assets/v2/assets/js/jquery-nice-select-1.1.0/js/jquery.nice-select.js"></script>
    <link rel="stylesheet" href="/assets/v2/assets/js/jquery-nice-select-1.1.0/css/nice-select.css">

    {{-- MicroModal Js --}}
    <script src="https://unpkg.com/micromodal/dist/micromodal.min.js"></script>

    {{-- Froala Edito --}}
    <link href="/assets/v2/assets/froala/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/v2/assets/froala/css/plugins.pkgd.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/v2/assets/froala/css/themes/dark.min.css" rel="stylesheet" type="text/css" />
    <script src="/assets/v2/assets/froala/js/froala_editor.pkgd.min.js" type="text/javascript"></script>
    <script src="/assets/v2/assets/froala/js/plugins.pkgd.min.js" type="text/javascript"></script>
    

    @include('admin.template-parts.head-scripts')
</head>
<body>
<div id="container">

@include('admin.template-parts.navbar')

<!-- main content -->
<div id="workstation">
    <div id="workspace">
        @yield('content')
    </div>
    @include('admin.template-parts.sidebar')
</div>
<!-- main content -->
{{--@include('admin.template-parts.chat')--}}

{{--@include('admin.template-parts.footer')--}}
</div>
</body>
</html>
