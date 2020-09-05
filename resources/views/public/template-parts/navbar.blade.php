<!-- section - responsive nav -->

<div class="uk-navbar-container" uk-navbar>
    <div class="uk-navbar-right uk-margin-small-right">
        <a class="uk-navbar-toggle" uk-navbar-toggle-icon href="" uk-toggle="target: #offcanvas-reveal"></a>
    </div>

    @if(Auth::check())
    <div class="uk-navbar-left uk-margin-left-right">
        <a href="{{ route('logout') }}" class="uk-navbar-toggle" uk-tooltip="title: logout from {{ Auth::user()->email }}; pos: right"><span uk-icon="icon: push"></span></a>
    </div>
    @endif
</div>

<div id="offcanvas-reveal" uk-offcanvas="mode: reveal; overlay: true">
    <div class="uk-offcanvas-bar">

        <button class="uk-offcanvas-close" type="button" uk-close></button>

        <!-- menu items -->
        <hr>

        <a class="uk-text-meta" href="{{ route('User > Messages') }}"><span uk-icon="comments"></span> | پیام‌های شما</a>
        <br><br>
        <a class="uk-text-meta uk-margin-medium-top uk-margin-medium-bottom" href="{{ route('User > Verification') }}"><span uk-icon="users"></span> | احراز هویت</a>

        <ul uk-accordion>
            <li>
                <a class="uk-accordion-title uk-text-meta"><span uk-icon="strikethrough"></span> | مدیریت مالی</a>
                <div class="uk-accordion-content">
                    <h4 class="uk-text-meta uk-margin-medium-right uk-margin-remove-top"><span uk-icon="cart"></span> <a href="{{ route('User > Buy Coin') }}">خرید ارز</a></h4>
                    <h4 class="uk-text-meta uk-margin-medium-right uk-margin-remove-top"><span uk-icon="credit-card"></span> <a href="{{ route('User > Sell Coin') }}">فروش ارز</a></h4>
                    <h4 class="uk-text-meta uk-margin-medium-right uk-margin-remove-top"><span uk-icon="file-text"></span> <a href="{{ route('User > Receipt > Archive') }}">فاکتورهای من</a></h4>
                </div>
            </li>
        </ul>

        <a class="uk-text-meta" href=""><span uk-icon="settings"></span> | تنظیمات حساب</a>
        <!-- menu items -->

    </div>
</div>

<!-- section - responsive nav -->
