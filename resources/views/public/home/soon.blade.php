<!DOCTYPE html>
<html lang="en">
<head>
	<title>Coming Soon 3</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="soon/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="soon/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="soon/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="soon/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="soon/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="soon/css/util.css">
	<link rel="stylesheet" type="text/css" href="soon/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	
	<div class="bg-img1 size1 flex-w flex-c-m p-t-55 p-b-55 p-l-15 p-r-15" style="background-image: url('soon/images/bg01.jpg');">
		<div class="wsize1 bor1 bg1 p-t-175 p-b-45 p-l-15 p-r-15 respon1" style="padding-top: 3%">
			<div class="wrappic1">
				<!-- <img src="soon/images/icons/cc.png" alt="LOGO" style="width: 20%;"> -->
				<h1 style="font-size: 5rem; font-family: Popins-regular; color: white; text-shadow: 0px 0px 10px rgba(0,0,0,0.25);">Cryptiner</h1>
			</div>

			<h1 class="txt-center m1-txt1 p-t-33 p-b-68" style="direction: rtl; font-weight: bold; font-family: Iran-Sans;">
				کریپتاینر به زودی در خدمت شما
			</h1>

			<div class="wsize2 flex-w flex-c hsize1 cd100">
				<div class="flex-col-c-m size2 how-countdown">
					<span class="l1-txt1 p-b-9 days">35</span>
					<span class="s1-txt1">Days</span>
				</div>

				<div class="flex-col-c-m size2 how-countdown">
					<span class="l1-txt1 p-b-9 hours">17</span>
					<span class="s1-txt1">Hours</span>
				</div>

				<div class="flex-col-c-m size2 how-countdown">
					<span class="l1-txt1 p-b-9 minutes">50</span>
					<span class="s1-txt1">Minutes</span>
				</div>

				<div class="flex-col-c-m size2 how-countdown">
					<span class="l1-txt1 p-b-9 seconds">39</span>
					<span class="s1-txt1">Seconds</span>
				</div>
			</div>

			<form class="flex-w flex-c-m contact100-form validate-form p-t-55">
				
				<button class="flex-c-m s1-txt3 size3 how-btn trans-04 where1">
					<span style="font-family: Iran-Sans; font-size: 0.8rem;">خبر بده</span>
				</button>

				<div class="wrap-input100 validate-input where1" data-validate = "Email is required: ex@abc.xyz">
					<input class="s1-txt2 placeholder0 input100" type="text" name="email" placeholder="ایمیل شما" style="font-family: Iran-Sans; font-size: 0.8rem;">
					<span class="focus-input100"></span>
				</div>
				
			</form>

			<p class="s1-txt4 txt-center p-t-10">
				<!-- I promise to <span class="bor2">never</span> spam -->
			</p>
			
		</div>
	</div>



	

<!--===============================================================================================-->	
	<script src="soon/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="soon/vendor/bootstrap/js/popper.js"></script>
	<script src="soon/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="soon/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="soon/vendor/countdowntime/moment.min.js"></script>
	<script src="soon/vendor/countdowntime/moment-timezone.min.js"></script>
	<script src="soon/vendor/countdowntime/moment-timezone-with-data.min.js"></script>
	<script src="soon/vendor/countdowntime/countdowntime.js"></script>
	<script>
		$('.cd100').countdown100({
			/*Set Endtime here*/
			/*Endtime must be > current time*/
			endtimeYear: 0,
			endtimeMonth: 0,
			endtimeDate: 35,
			endtimeHours: 18,
			endtimeMinutes: 0,
			endtimeSeconds: 0,
			timeZone: "" 
			// ex:  timeZone: "America/New_York"
			//go to " http://momentjs.com/timezone/ " to get timezone
		});
	</script>
<!--===============================================================================================-->
	<script src="soon/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="soon/js/main.js"></script>

</body>
</html>