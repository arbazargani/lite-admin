{{-- Sidebar Start --}}
<div id="sidebar">
    <div class="sidebar-wrap">
        <ul class="sidebar-nav-ul">
            <a href="{{ route('User > Panel') }}">
                <li>
                    <i class="fal fa-home"></i>
                    <p>داشبورد</p>
                </li>
            </a>
            <a href="{{ route('User > Messages') }}">
                <li>
                    <i class="fal fa-bell"></i>
                    <p>اعلانات</p>
                </li>
            </a>
            <a href="{{ route("User > Profile") }}">
                <li>
                    <i class="fal fa-user"></i>
                    <p>پروفایل</p>
                </li>
            </a>
            <a href="{{ route("User > Receipt > Archive") }}">
                <li>
                    <i class="fab fa-bitcoin"></i>
                    <p>خرید ها</p>
                </li>
            </a>
            <a href="{{ route("User > Transaction > Archive") }}">
                <li>
                    <i class="fal fa-donate"></i>
                    <p>فروش ها</p>
                </li>
            </a>
            <!-- <a href="#">
                <li>
                    <i class="fal fa-balance-scale"></i>
                    <p>اکسچنج</p>
                </li>
            </a> -->
            <a href="#">
                <li>
                    <i class="fal fa-question"></i>
                    <p>تیکت ها</p>
                </li>
            </a>
            <a href="{{ route("2fa") }}">
                <li>
                    <i class="fas fa-user-lock"></i>
                    <p>ورود دو مرحله‌ای</p>
                </li>
            </a>
            <a href="{{ route('logout') }}">
                <li>
                    <i class="fas fa-sign-out-alt"></i>
                    <p>خروج</p>
                </li>
            </a>
        </ul>
    </div>
</div>
<div class="sidebar-overlay"></div>
{{-- Sidebar Ends --}}
