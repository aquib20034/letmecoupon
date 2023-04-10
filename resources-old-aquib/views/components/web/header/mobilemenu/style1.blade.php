<div class="mobileMenuStyle1">
    <div class="mobileMenu">
        <div class="mobileMenu__overlay" onclick="toggleHeader1MobileMenu()"></div>
        <div class="mobileMenu__wrapper">
            <div class="mobileMenu__header">
                <a href="{{ config('app.app_path') }}" class="mobileMenu__logo" aria-label="Visit Home Page">
                    <figure>
                        <img src="../../build/images/header-logo.webp" alt="Logo">
                    </figure>
                </a>

                <button type="button" class="mobileMenu__closeBtn" aria-label="Close Side Menu" onclick="toggleHeader1MobileMenu()">
                    <i class="x_close"></i>
                </button>
            </div>

            <div class="mobileMenu__body">
                <ul class="sideNavigation">
                    <li onclick="toggleSideNavAccordion(this)">
                        <a href="javascript:;" aria-label="Top Shops"><span>Top Shops</span><i class="x_arrow-down-2 chevron-icon"></i></a>

                        <ul class="box-coupons sideDropdown" onclick="toggleHeader1MobileMenu()">
                            <li><a href="{{ config('app.app_path') }}/store-inner" aria-label="Visit Store Inner Page">Amazon</a></li>
                            <li><a href="{{ config('app.app_path') }}/store-inner" aria-label="Visit Store Inner Page">Cdiscount</a></li>
                            <li><a href="{{ config('app.app_path') }}/store-inner" aria-label="Visit Store Inner Page">The Redoubt</a></li>
                            <li><a href="{{ config('app.app_path') }}/store-inner" aria-label="Visit Store Inner Page">Aliexpress</a></li>
                        </ul>
                    </li>

                    <li onclick="toggleSideNavAccordion(this)">
                        <a href="javascript:;" aria-label="Categories"><span>Categories</span> <i class="x_arrow-down-2 chevron-icon"></i></a>

                        <ul class="box-categories sideDropdown" onclick="toggleHeader1MobileMenu()">
                            <li><a href="{{ config('app.app_path') }}/category-inner" aria-label="Visit Category Inner Page">Amazon</a></li>
                            <li><a href="{{ config('app.app_path') }}/category-inner" aria-label="Visit Category Inner Page">Cdiscount</a></li>
                            <li><a href="{{ config('app.app_path') }}/category-inner" aria-label="Visit Category Inner Page">The Redoubt</a></li>
                            <li><a href="{{ config('app.app_path') }}/category-inner" aria-label="Visit Category Inner Page">Aliexpress</a></li>
                        </ul>
                    </li>

                    <li onclick="toggleSideNavAccordion(this)">
                        <a href="javascript:;" aria-label="United States">
                            <span>United States</span>
                            <div class="flag-image">
                                <img src="../../build/images/flag.webp" alt="Flag">
                            </div>
                            <i class="x_arrow-down-2 chevron-icon"></i>
                        </a>

                        <?php
                        $countries = array(
                            'United Kingdom', 'Australia', 'Ireland', 'Germany', 'Switzerland', 'Austria', 'Poland', 'France', 'Netherlands', 'Finland', 'Spain', 'Italy', 'Norway', 'Czech Republic', 'Sweden', 'Denmark', 'Canada', 'New Zealand', 'Pakistan', 'Mexico', 'Turkey', 'Belgium', 'Hungary', 'Romania', 'Argentina', 'Portugal', 'Luxembourg', 'Colombia'
                        );
                        $index = 0;
                        ?>
                        <ul class="box-countries sideDropdown" onclick="toggleHeader1MobileMenu()">
                            <?php foreach ($countries as $country) : ?>
                                <li class="<?php echo $index < 5 ? 'show-initially' : '' ?>">
                                    <a href="javascript:;" aria-label="<?php echo $country ?>"><?php echo $country ?></a>
                                </li>
                                <?php $index++ ?>
                            <?php endforeach; ?>
                        </ul>
                    </li>

                    <li><a href="{{ config('app.app_path') }}/blogs" aria-label="Visit Blogs Page"><span>Blogs</span></a></li>
                    <li><a href="{{ config('app.app_path') }}/reviews" aria-label="Visit Blogs Page"><span>Reviews</span></a></li>
                    <li><a href="{{ config('app.app_path') }}/about-us" aria-label="Visit About Us Page"><span>About Us</span></a></li>
                    <li><a href="{{ config('app.app_path') }}/contact-us" aria-label="Visit Contact Us Page"><span>Contact Us</span></a></li>
                </ul>
            </div>

            <div class="mobileMenu__footer">
                <div class="mobileMenu__socialLinks">
                    <a href="https://www.facebook.com/" target="_blank" rel="nofollow noopener noreferrer" aria-label="Visit Our Facebook Profile">
                        <i class="x_facebook"></i>
                    </a>
                    <a href="https://www.twitter.com/" target="_blank" rel="nofollow noopener noreferrer" aria-label="Visit Our Twitter Profile">
                        <i class="x_twitter"></i>
                    </a>
                    <a href="https://www.instagram.com/" target="_blank" rel="nofollow noopener noreferrer" aria-label="Visit Our Instagram Profile">
                        <i class="x_instagram"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>