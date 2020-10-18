<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    {{-- Meta Tags --}}
    <meta charset="UTF-8">
    <title> {{ env('APP_NAME') }} </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favication icon -->
	<link rel="apple-touch-icon" sizes="180x180" href="/assets/v3/src/favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/assets/v3/src/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="194x194" href="/assets/v3/src/favicon/favicon-194x194.png">
	<link rel="icon" type="image/png" sizes="192x192" href="/assets/v3/src/favicon/android-chrome-192x192.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/assets/v3/src/favicon/favicon-16x16.png">
	<link rel="manifest" href="/assets/v3/src/favicon/site.webmanifest">
	<link rel="mask-icon" href="/assets/v3/src/favicon/safari-pinned-tab.svg" color="#232424">
	<meta name="msapplication-TileColor" content="#292929">
	<meta name="theme-color" content="#1c1c1c">
	<!-- End Favication icon -->

    {{-- Assets and styles --}}
    <link type="text/css" rel="stylesheet" media="all" href="/assets/v3/panel/style.css">

    <!--Font Awsome-->
	<link href="/assets/v3/assets/fonts/fontawesome-pro-5.14.0-web/css/all.min.css" rel="stylesheet">

    <!--CryptoFont-->
    <link href="/assets/v3/assets/fonts/cryptofont-1.2.0/cryptofont.css" rel="stylesheet">

    <!--jQuery Nice Select-->
    <script src="/assets/v3/assets/js/jquery-nice-select-1.1.0/js/jquery.js"></script>
    <script src="/assets/v3/assets/js/jquery-nice-select-1.1.0/js/jquery.nice-select.js"></script>
    <link rel="stylesheet" href="/assets/v3/assets/js/jquery-nice-select-1.1.0/css/nice-select.css">

    <!-- Theme js -->
    <script type="text/javascript" src="/assets/v3/assets/js/headjs.js"></script>
</head>
<body>
<div id="container">

@include('user.template-parts.navbar')

<!-- main content -->
    <div id="workstation">
        <div id="workspace">
            @yield('content')
        </div>
        @include('user.template-parts.sidebar')
    </div>
<!-- main content -->
    @include('admin.template-parts.footer')
</div>
</body>
</html>
