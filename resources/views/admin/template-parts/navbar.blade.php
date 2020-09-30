{{-- Navbar start --}}
<div id="header">
    <div id="top-haeder">
        <div class="top-haeder-info">
            <div class="user-info">
                <div class="user-avatar">
                    <img alt="User Avatar" src="https://i1.sndcdn.com/avatars-000289622160-xnbwqi-t500x500.jpg">
                </div>
                <div class="username">
                    <a href="#">{{ Auth::user()->name }}</a>
                    <i class="fas fa-user"></i>
                </div>
            </div>
            <div class="page-title">
                <!-- <h2>کریپتو</h2> -->
                <div class="dash-header-logo">
                    <img src="/assets/logo.png" style="height: 75px !important">
                </div>
            </div>
            <div id="sidebar-toggle" class="page-options sidebar-toggle">
                <!-- <a href="#">Fa</a> -->
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
