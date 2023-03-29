<header class="header">
    <div class="header__wrapper container">
        <div class="header__left">
            <a href="{{ config('app.app_path') }}" class="header__logo" aria-label="{{$title}}">
                <picture>
                    <source media="(max-width:768px)" srcset="{{ config('app.image_path') . '/build/images/header-mobile-logo.webp' }}">
                    <img 
                        src="{{ config('app.image_path') . '/build/images/placeholder.png' }}"
                        data-src="{{ !empty($global_data['site_logo']) ? $global_data['site_logo'] : config('app.image_path') . '/build/images/header-logo.webp' }}"
                        alt="logo" />
                </picture>
            </a>
        </div>

        <div class="header__right">
            <div class="header__search">
                @web_component([ 'postfixes' => 'header.search.style1','data' => [] ])@endweb_component
            </div>

            <div class="header__navigation">
                @web_component([ 'postfixes' => 'header.navigation.style1','data' => [] ])@endweb_component
            </div>

            <div class="header__dropdown">
                @web_component([ 'postfixes' => 'header.region.style1','data' => [] ])@endweb_component
            </div>

            <div class="header__mobileMenu">
                <button type="button" aria-label="Toggle Side Menu" onclick="toggleHeader1MobileMenu()">
                    <i class="x_menu-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                        <span class="path4"></span>
                    </i>
                </button>

                <div class="headerMobileMenu__drawer">
                    @web_component([ 'postfixes' => 'header.mobilemenu.style1','data' => [] ])@endweb_component
                </div>
            </div>
        </div>
    </div>
</header>