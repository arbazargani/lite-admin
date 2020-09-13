{{-- Sidebar Start --}}
<div id="sidebar">
    <div class="sidebar-wrap">
        <ul class="sidebar-nav-ul">
            <a href="{{ route('Admin > Dashboard') }}">
                <li>
                    <i class="fal fa-home"></i>
                    <p>داشبورد</p>
                </li>
            </a>
            <a href="{{ route('Admin > Users > Manage') }}">
                <li>
                    <i class="fal fa-users"></i>
                    <p>کاربران</p>
                </li>
            </a>
            <a href="#">
                <li>
                    <a href="{{ route('Admin > Receipts > List') }}" style="color: rgba(134, 138, 168, 1)">
                        <i class="fab fa-bitcoin"></i>
                        <p>خرید ها</p>
                    </a>
                </li>
            </a>
            <a href="{{ route('Admin > Transactions > Verification List') }}" style="color: rgba(134, 138, 168, 1)">
                <li>
                    <i class="fal fa-donate"></i>
                    <p>فروش ها</p>
                </li>
            </a>
            <a href="#">
                <li>
                    <i class="fal fa-balance-scale"></i>
                    <p>اکسچنج</p>
                </li>
            </a>
            <a href="{{ route('Admin > Settings > Show') }}">
                <li>
                    <i class="fal fa-cogs"></i>
                    <p>تنظیمات</p>
                </li>
            </a>
            <a href="#">
                <li>
                    <i class="fal fa-question"></i>
                    <p>تیکت ها</p>
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
{{-- Sidebar Ends --}}
