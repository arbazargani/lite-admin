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
                    <img src="/assets/v2/src/img/dash-log.png">
                </div>
            </div>
            <div class="page-options">
                <a href="#">Fa</a>
                <i class="fas fa-arrow-down"></i>
            </div>
        </div>
    </div>
    <div id="bot-haeder">
        <div class="bot-haeder-timeline">

        </div>
    </div>
</div>
{{-- Navbar Ends --}}
