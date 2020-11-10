<!doctype html>
<html>
<head>
	<title>{{ $settings['application_index_meta_title']->value }}</title>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="{{ $settings['application_index_meta_robots']->value }}">
	<meta name="description" content="{{ $settings['application_index_meta_description']->value }}">
	<meta name="keywords" content="{{ $settings['application_index_meta_keyword']->value }}">
	<meta name="author" content="cryptiner.com">
	<meta name="theme-color" content="#00bfd6">
	<link rel="canonical" href="{{ env('APP_URL') }}">

	<!-- Favication icon -->
	<link rel="apple-touch-icon" sizes="180x180" href="/assets/v3/src/favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/assets/v3/src/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="194x194" href="/assets/v3/src/favicon/favicon-194x194.png">
	<link rel="icon" type="image/png" sizes="192x192" href="/assets/v3/src/favicon/android-chrome-192x192.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/assets/v3/src/favicon/favicon-16x16.png">
	<link rel="manifest" href="/assets/v3/src/favicon/site.webmanifest">
	<link rel="mask-icon" href="/assets/v3/src/favicon/safari-pinned-tab.svg" color="#232424">
	<meta name="msapplication-TileColor" content="#292929">
	<meta name="theme-color" content="#46D1AA">
	<!-- End Favication icon -->



	<link type="text/css" rel="stylesheet" media="all" href="/assets/v3/style.css">
		
	<!--Font Awsome-->
	<link href="/assets/v3/assets/fonts/fontawesome-pro-5.14.0-web/css/all.min.css" rel="stylesheet">

	<!--load all styles -->
	<script defer src="/assets/v1/assets/fonts/fontawesome-pro/js/all.min.css"></script> 
	<!--load all styles -->
	
	<!--CryptoFont-->
	<link href="/assets/v3/assets/fonts/cryptofont-1.2.0/cryptofont.css" rel="stylesheet">

	<!--jQuery Nice Select-->
	<script src="/assets/v3/assets/js/jquery-nice-select-1.1.0/js/jquery.js"></script> 
	<script src="/assets/v3/assets/js/jquery-nice-select-1.1.0/js/jquery.nice-select.js"></script>
	<link rel="stylesheet" href="/assets/v3/assets/js/jquery-nice-select-1.1.0/css/nice-select.css">
	<script>
	$(document).ready(function() {
	  $('select').niceSelect();
	});
		
	function nav_toggle() {
	  var x = document.getElementById("header-nav");
	  if (x.className === "sub-header-nav") {
		x.className += " responsive-nav";
	  } else {
		x.className = "sub-header-nav";
	  }

	  var z = document.getElementsByClassName("sub-header-div");
		if(z[0].className === "sub-header-div"){
			z[0].className += " responsive-header";
		}else{
			z[0].className = "sub-header-div";
		}
	} 
	</script>	
</head>
<body>
@yield('content')
</body>
</html>