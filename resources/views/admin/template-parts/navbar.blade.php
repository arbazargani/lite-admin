{{-- Navbar start --}}
	<div id="header">
		<div id="top-haeder">
			<div class="top-haeder-info">
				<div class="user-info">
					<div class="user-avatar">
						<a href="#"><img alt="User Avatar" src="https://i1.sndcdn.com/avatars-000289622160-xnbwqi-t500x500.jpg"></a>
					</div>
					<div class="username-badge">
						<a href="#">{{ Auth::user()->name }}</a>
						<i class="fas fa-user"></i>
					</div>
				</div>
				<div class="page-title">
					<div class="page-title-logo">
						<a href="{{ route('Admin > Dashboard') }}"><img src="/assets/v3/src/img/logo-black.png"></a>
					</div>
				</div>
				<div id="sidebar-toggle" class="page-options sidebar-toggle">
					<i class="fas fa-bars"></i>
				</div>
			</div>
		</div>
		<div id="bot-haeder">
			<div class="bot-haeder-timeline">

			</div>
		</div>
	</div>
{{-- Navbar Ends --}}
