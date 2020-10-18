<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>احراز هویت</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="{{ env('APP_URL') }}">

		<!-- MATERIAL DESIGN ICONIC FONT -->
		<link rel="stylesheet" href="/assets/auth/fonts/material-design-iconic-font/css/material-design-iconic-font.css">

		<!-- STYLE CSS -->
		<link rel="stylesheet" href="/assets/auth/css/style.css">
 
		<!-- Custom File Input CSS -->
		<link rel="stylesheet" href="/assets/auth/css/file/component.css">

	</head>
	<body>
			@if(Auth::check() && Auth::user()->status == 'suspended')
			<div class="wrapper">
				<form action="{{ route('User > Verification') }}" method="post" enctype="multipart/form-data" id="wizard" class="auth_form">
					@csrf
					<!-- SECTION 0 -->
					<h2></h2>
					<section>
						<div class="inner">
							<div class="image-holder">
								<img src="/assets/auth/images/slide-0.jpg" alt="">
							</div>	
							<div class="form-content" >
								<div class="form-header">
									<h3>فرم احراز هویت</h3>
								</div>
								
								<div class="form-row">
									<div class="wizard-rules-wrap">
										<h4>لطفا نکات زیر را رعایت فرمایید</h4>
										<ul>
											<li>تمامی مشخصات داده شده باید درست و مطعلق به شخص خود شما باشد</li>
											<li>دقت کنید که مشخصات کارت و حساب بانکی باید به اسم خود شما و کارت ملی ارسالی باشد</li>
											<li>قایل های ارسالی برای تصویر شناسنامه، کارت ملی و کارت بانکی باید در فرمت JPG و با حجمی کمتر از 1mb آپلود شوند</li>
										</ul>
									</div>
								</div>

							</div>
						</div>
					</section>

					<!-- SECTION 1 -->
					<h2></h2>
					<section>
						<div class="inner">
							<div class="image-holder">
								<img src="/assets/auth/images/slide-1.jpg" alt="">
							</div>	
							<div class="form-content" >
								<div class="form-header">
									<h3>فرم احراز هویت</h3>
								</div>
								<div class="form-row">
									<div class="form-holder">
										<div>
											<!-- <p>تصویر کارت ملی</p> -->
											<input type="file" name="national_card" id="national_card" class="my-fileinput inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple="">
											<label for="national_card"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg> <span>تصویر کارت ملی</span></label>
										</div>
									</div>
									<div class="form-holder">
										<div>
											<!-- <p>تصویر شناسنامه</p> -->
											<input type="file" name="birth_certificate" id="birth_certificate" class="my-fileinput inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple="">
											<label for="birth_certificate"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg> <span>تصویر شناسنامه</span></label>
										</div>
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder">
										<input type="text" placeholder="تلفن همراه" class="form-control" name="phone_number">
									</div>
									<div class="form-holder">
										<input type="text" placeholder="شماره ملی" class="form-control" name="national_code">
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder">
										<div class="checkbox-tick">
											<label class="male">
												<input type="radio" name="gender" value="male" class="" checked> مرد<br>
												<span class="checkmark"></span>
											</label>
											<label class="female">
												<input type="radio" name="gender" value="female" class=""> زن<br>
												<span class="checkmark"></span>
											</label>
										</div>
									</div>
								</div>
							</div>
						</div>
					</section>
					<!-- SECTION 2 -->
					<h2></h2>
					<section>
						<div class="inner">
							<div class="image-holder">
								<img src="/assets/auth/images/slide-2.jpg" alt="">
							</div>
							<div class="form-content">
								<div class="form-header">
									<h3>فرم احراز هویت</h3>
								</div>
								<p style="direction: rtl">لطفا در صحت اطلاعات ورودی دقت کنید.</p>
								<div class="form-row">
									<div class="form-holder w-100">
										<input type="text" placeholder="آدرس" class="form-control" name="home_address">
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder">
										<input type="text" placeholder="شهر" class="form-control" name="city">
									</div>
									<div class="form-holder">
										<input type="text" placeholder="شماره ثابت" class="form-control" name="home_number">
									</div>
								</div>

								<div class="form-row">
									<div class="select">
										<div class="form-holder"></div>
									</div>
									<div class="form-holder"></div>
								</div>
							</div>
						</div>
					</section>

					<!-- SECTION 3 -->
					<h2></h2>
					<section>
						<div class="inner">
							<div class="image-holder">
								<img src="/assets/auth/images/slide-3.jpg" alt="">
							</div>
							<div class="form-content">
								<div class="form-header">
									<h3>فرم احراز هویت</h3>
								</div>
								
								<div class="form-row">
									<div class="form-holder">
										<input type="text" placeholder="شماره کارت" class="form-control" name="credit_card">
									</div>
									<div class="form-holder">
										<input type="text" placeholder="شماره حساب" class="form-control" name="credit_account">
									</div>
								</div>
								<div class="form-row">
									<div class="form-holder w-100">
										<input type="text" placeholder="شماره شبا" class="form-control" name="sheba_account">
									</div>
								</div>
								{{-- <div class="form-row">
									<div class="form-holder">
										<!-- <p class="input-title">تصویر کارت بانکی</p> -->
										<input type="file" name="file-1[]" id="file-1" class="my-fileinput inputfile inputfile-1" data-multiple-caption="{count} files selected" multiple="">
										<label for="file-1"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"></path></svg> <span>تصویر کارت بانکی</span></label>
									</div>
								</div> --}}
								<div class="checkbox-circle mt-24">
									<label>
										<input type="checkbox" checked required>  من تمامی <a href="#">قوانین و مقررات سایت</a> را قبول می کنم.
										<span class="checkmark"></span>
									</label>
								</div>
							</div>
						</div>
					</section>
					
				</form>
			</div>
			@endif
			@if(Auth::check() && Auth::user()->status == 'waiting')
			<div class="wrapper" style="height: 100vh !important; background: url(/assets/auth/images/bg3.jpg) center center">
				<p style="
					padding: 1px;
					background: #ffffff;
					border-radius: 7px;
					font-size: 1rem;
					direction: rtl;
					font-family: Iran-Sans;
				">
				<img src="https://static.dribbble.com/users/251873/screenshots/9288094/13539-sign-for-error-or-explanation-alert.gif" alt="" srcset="" style="width: 35px; height: auto; vertical-align: middle">مدارک شما هنوز تایید نشده است. لطفا منتظر بمانید.</p>
			</div>
			@endif

			@if(Auth::check() && Auth::user()->status == 'verified')
			<div class="wrapper" style="height: 100vh !important; background: url(/assets/auth/images/bg3.jpg) center center">
				<p style="
				padding: 1px;
				background: #ffffff;
				border-radius: 7px;
				font-size: 1rem;
				direction: rtl;
				font-family: Iran-Sans;
				">
				<img src="https://thumbs.gfycat.com/ShyCautiousAfricanpiedkingfisher-size_restricted.gif" alt="" srcset="" style="width: 15px; height: auto; vertical-align: middle">
				مدارک شما تایید شده است. می‌توانید از امکانات پنل استفاده نمایید.</p>
			</div>
			@endif
			@if ($errors->any())
			<!-- Toast JS  -->
			<script src="/assets/auth/toastify/toastify.js"></script>
			<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
			<link rel="stylesheet" href="/assets/auth/toastify/toastify.css">
			<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
			<script>
				Toastify({
					text: '<ul>@foreach ($errors->all() as $error)<li>{{$error}}</li>@endforeach</ul>',
					// Toast position - top or bottom
					gravity: 'top',
					// Toast position - left or right
					positionLeft: false,
					position: 'center',
					// Background color
					backgroundColor: "linear-gradient(135deg, #73a5ff, #5477f5)",
					// Prevents dismissing of toast on hover
					stopOnFocus: true,
					duration: 5000,
					// close: true,

				}).showToast();
			</script>
		@endif
		
		<!-- JQUERY -->
		<script src="/assets/auth/js/jquery-3.3.1.min.js"></script>

		<!-- JQUERY STEP -->
		<script src="/assets/auth/js/jquery.steps.js"></script>
		<script src="/assets/auth/js/main.js"></script>
		<!-- Template created and distributed by Colorlib -->

		<!-- Custom File Input JS  -->
		<script src="/assets/auth/js/custom-file-input.js"></script>

</body>
</html>
