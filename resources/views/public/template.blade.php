<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title> کریپتاینر | {{ env('APP_NAME') }} </title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link type="text/css" rel="stylesheet" media="all" href="/assets/v3/style.css">
		
	<!--Font Awsome-->
	<link href="/assets/v3/assets/fonts/fontawesome-pro-5.14.0-web/css/all.min.css" rel="stylesheet">

	<!--load all styles -->
	<script defer src="/assets/v1/assets/fonts/fontawesome-pro/js/all.min.js"></script> 
	<!--load all styles -->
	
	<!--CryptoFont-->
	<link href="/assets/v1/assets/fonts/cryptofont-1.2.0/cryptofont.css" rel="stylesheet">

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