@extends('web.layouts.app')
@section('content')

    <div class="container">
        <div class="section">
            <!-- Banner Section Starts Here -->
            <section class="section">
                @web_component([ 'postfixes' => 'banner.home.style1','data' => [] ])@endweb_component
            </section>
            <!-- Banner Section Ends Here -->

            <!-- Blog Slider Section Starts Here -->
            <section class="section">
                @web_component([ 'postfixes' => 'categories.slider.style1','data' => [] ])@endweb_component
            </section>
            <!-- Blog Slider Section Ends Here -->

            <!-- Trending Blogs & Reviews Section Starts Here -->
            <section class="section">
                @web_component([ 'postfixes' => 'blogs.trending.style1','data' => [] ])@endweb_component
            </section>
            <!-- Trending Blogs & Reviews Section Ends Here -->

            <!-- Popular Categories Section Starts Here -->
            <section class="section">
                @web_component([ 'postfixes' => 'categories.popular.style1','data' => [] ])@endweb_component
            </section>
            <!-- Popular Categories Section Ends Here -->

            <!-- Newsletter Section Starts Here -->
            <section class="section">
                <?php //include('../components/NewsLetterForm/Style1/index.php'); ?>
                @web_component([ 'postfixes' => 'newsletter.style1','data' => [] ])@endweb_component
            </section>
            <!-- Newsletter Section Starts Here -->

            <!-- Popular Stores & Brands Section Starts Here -->
            <section class="section">
                @web_component([ 'postfixes' => 'stores.popular.style1','data' => [] ])@endweb_component
            </section>
            <!-- Popular Stores & Brands Section Ends Here -->

            <!-- Popular Reviews Section Starts Here -->
            <section class="section">
                @web_component([ 'postfixes' => 'reviews.popular.style1','data' => [] ])@endweb_component
            </section>
            <!-- Popular Reviews Section Ends Here -->
        </div>
    </div>

    <main class="main homepage @if (!isset($trendingCoupons) || !isset($recommendedCoupons)) errorPage @endif" style="display:none !important">
        @if (!isset($trendingCoupons) || !isset($recommendedCoupons))
            <!-- 404 Found -->
            <section class="section">
                <div class="container">
                    <div class="parent">
                        <div class="svg-wrp"> <svg xmlns="http://www.w3.org/2000/svg" width="375" height="308"
                                viewBox="0 0 375 308">
                                <g id="Group_8983" data-name="Group 8983" transform="translate(-771.5 -152.146)">
                                    <text id="_404" data-name="404" transform="translate(809.5 372.146)"
                                        fill="var(--cms-primary-color) /** CMS_PRIMARY_COLOR **/"
                                        stroke="var(--cms-primary-color) /** CMS_PRIMARY_COLOR **/" stroke-width="38"
                                        font-size="170" font-family="OpenSans-Extrabold, Open Sans" font-weight="800">
                                        <tspan x="0" y="0">{{ trans('sentence.404_heading') }}</tspan>
                                    </text>
                                    <ellipse id="Ellipse_269" data-name="Ellipse 269" cx="28" cy="27.5"
                                        rx="28" ry="27.5" transform="translate(931 287)" fill="#fff" />
                                </g>
                            </svg>
                        </div>
                        <p class="title">{{ trans('sentence.404_heading_one') }}</p>
                        <p class="sub-title">{{ trans('sentence.404_sub') }}</p>
                        <div class="sec-btn-wrp">
                            <a href="{{ config('app.app_path') }}"
                                class="secondary-btn">{{ trans('sentence.404_goto_home_page') }}</a>
                        </div>
                    </div>
                </div>
            </section>
            @if (isset($topPopularCoupons))
                <div class="container">
                    <div class="section coupons-main-wrapper padding-bottom-none padding-top-none">
                        <h2 class="top-heading bold">{{ trans('sentence.top_voucher') }}</h2>
                        <div class="cp-grid-2">
                            @php $i = 0; @endphp
                            @foreach ($topPopularCoupons as $coupon)
                                @include(
                                    'web.common.cards.coupon.full.' . $global_data['coupon_card_style_primary'],
                                    ['variant' => 'half']
                                )

                                @php $i++; @endphp
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            <!-- 404 Not Found Ends Here -->
        @else
            <div class="container">
                <!-- Coupon search section start -->
                <section class="section">
                    <div class="coupon-search">
                        <h1 class="top-heading bolder">{{ trans('sentence.heading_one') }}</h1>
                        <h2 class="secondary-heading center">{{ trans('sentence.heading_two') }}</h2>
                        <div class="searchbox searchbar search-bar">
                            <input type="search" name="search" class="searchbar-input" id="searchInputHome"
                                placeholder="{{ trans('sentence.search_lbl_field') }}" />
                            <a href="javascript:;" class="btn search-btn" aria-label="Search Button">
                                <i class="x_search"></i>
                            </a>
                            <ul class="searchbox__result" id="searchBoxResult">
                                @foreach ($topStores as $topStore)
                                    <li><a
                                            href="{{ config('app.app_path') }}/{{ isset($topStore['slugs']) ? $topStore['slugs']['slug'] : '#' }}">{{ $topStore['name'] }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </section>
                <!-- Coupon search section start -->

                <!-- Slider section start -->
                @if (isset($banners))
                    <section class="section padding-top-none">
                        <div class="slider swiper-container">
                            <div class="swiper-wrapper">
                                @foreach ($banners as $banner)
                                    <a class="swiper-slide" href="{{ addHttps($banner['link']) }}">
                                        <div class="slidewrapper">
                                            <div class="slidebg"
                                                style="background-image: url({{ !empty($banner['banner_image']) ? $banner['banner_image'] : config('app.image_path') . '/build/images/banner.webp)' }})"
                                                data-bgimage>
                                            </div>
                                            <div class="slide-content">
                                                <div class="content">
                                                    @if (!empty($banner['link']) && !empty($banner['button_text']))
                                                        <button href="{{ addHttps($banner['link']) }}" type="button"
                                                            class="btn has_icon"><span>{{ $banner['button_text'] }} <i
                                                                    class="x_arrowright"></i></span></button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                            <div class="swiper-controls">
                                <button aria-label="Slide Previous" class="navigations left">
                                    <i class="x_arrowleft"></i>
                                </button>
                                <button aria-label="Slide Next" class="navigations right">
                                    <i class="x_arrowright"></i>
                                </button>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </section>
                @endif
                <!-- Slider section end -->
            </div>

            @if (!empty($trendingCoupons))
                <!-- Coupon cards section start -->
                <div class="bgGrey">
                    <div class="container">
                        <section class="section coupon-card-section padding-top-none">
                            <h2 class="top-heading bold">{{ trans('sentence.trending_coupon') }}</h2>
                            <div class="cp-grid-2">
                                @foreach ($trendingCoupons as $coupon)
                                    @php
                                        $redirect_url = '';
                                        if (!empty($coupon['affiliate_url'])) {
                                            $redirect_url = $coupon['affiliate_url'];
                                        } elseif (isset($coupon['store'])) {
                                            if (!empty($coupon['store']['affiliate_url'])) {
                                                $redirect_url = $coupon['store']['affiliate_url'];
                                            } else {
                                                $redirect_url = $coupon['store']['store_url'];
                                            }
                                        }
                                    @endphp

                                    @include(
                                        'web.common.cards.coupon.minimal.' .
                                            $global_data['coupon_card_style_secondary'],
                                        ['variant' => 'half']
                                    )
                                @endforeach
                            </div>
                        </section>
                    </div>
                </div>
                <!-- Coupon cards section end -->
            @endif
            @if (!empty($topPopularCoupons))
                <!-- Voucher section start -->
                <div class="container">
                    <div class="section coupons-main-wrapper">
                        <h2 class="top-heading bold">{{ trans('sentence.top_voucher') }}</h2>
                        <div class="cp-grid-2">
                            @php $i = 0; @endphp
                            @foreach ($topPopularCoupons as $coupon)
                                @include(
                                    'web.common.cards.coupon.full.' . $global_data['coupon_card_style_primary'],
                                    ['variant' => 'half']
                                )

                                @php $i++; @endphp
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Voucher section end -->
            @endif

            @if (!empty($featuredStores))
                <!-- Featured Brands section start -->
                <div class="bgHighlight">
                    <div class="container ">
                        <section class="section ">
                            <div class="fb-section">
                                <h2 class="top-heading bold">{{ trans('sentence.featured_brands') }}</h2>
                                <div class="grid-column-9">
                                    @foreach ($featuredStores as $featuredStore)
                                        <a class="brand-box"
                                            href="{{ config('app.app_path') . '/' . $featuredStore['slugs']['slug'] }}"
                                            title="{{ $featuredStore['name'] ?? '' }}">
                                            <div class="brand-box">
                                                <div class="brand-img-box">
                                                    <img src="{{ config('app.image_path') }}/build/images/placeholder.png"
                                                        data-src="{{ isset($featuredStore['store_image']) ? $featuredStore['store_image'] : config('app.image_path') . '/build/images/placeholder.png' }}"
                                                        alt="{{ $featuredStore['name'] }}" height="70"
                                                        width="90" />
                                                </div>
                                                <div class="brand-text">
                                                    <p>{{ $featuredStore['name'] ?? '' }}</p>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <!-- Featured Brands section end -->
            @endif

            @if (!empty($totalCoupons))
                <!-- Performance counter section start -->
                <div class="bgDarkGrey per-counter-section">
                    <div class="container">
                        <section class="section">
                            <div class="counters-wrapper">
                                <div class="counter">
                                    <h3 class="numbers">{{-- isset($totalCoupons) ? number_format($totalCoupons, 0, '.', ',') : '0' --}}94110</h3>
                                    <p>{{ trans('sentence.total_offers') }}</p>
                                </div>
                                <div class="counter">
                                    <h3 class="numbers">{{-- isset($couponsAdded) && $couponsAdded > 100 ? number_format($couponsAdded, 0, '.', ',') : '150' --}}3851</h3>
                                    <p>{{ trans('sentence.total_offers_by_week') }}</p>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                <!-- Performance counter section end -->
            @endif

            <div class="container">
                @if (isset($recommendedCoupons))
                    <!-- Voucher section start -->
                    <section class="section coupons-main-wrapper">
                        <div class="coupons-main-wrapper">
                            <h2 class="top-heading bold">{{ trans('sentence.top_recommended_voucher') }}</h2>
                            <div class="cp-grid-2">
                                @php $i = 0; @endphp
                                @foreach ($recommendedCoupons as $coupon)
                                    @include(
                                        'web.common.cards.coupon.full.' .
                                            $global_data['coupon_card_style_primary'],
                                        ['variant' => 'half']
                                    )

                                    @php $i++; @endphp
                                @endforeach
                            </div>
                    </section>
                @endif

                @if (isset($popularStores))
                    <!-- Popular retailer section start -->
                    <section class="section popular-retailers padding-top-none">
                        <div class="similar-store no-border">
                            <h2 class="top-heading text-left bold">{{ trans('sentence.popular_retailer') }}</h2>
                            <ul class="outlined">
                                @foreach ($popularStores as $popularStore)
                                    <li><a href="{{ config('app.app_path') . '/' . $popularStore['slugs']['slug'] }}"
                                            class="tag">{{ $popularStore['name'] }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </section>
                    <!-- Popular retailer section end -->
                @endif

                <!-- Voucher section end -->

            </div>
            <!-- How it works section start here -->
            <div class="bgLightBlue hiw-section">
                <div class="container">
                    <section class="section">
                        <h2 class="top-heading bolder">{{ trans('sentence.how_it_works') }}</h2>
                        <div class="hiw-grid">
                            <div class="hiw-item">
                                <h3>{{ trans('sentence.what_are_coupon_code') }}</h3>
                                <p>{{ trans('sentence.what_are_coupon_code_desc') }}</p>
                            </div>
                            <div class="hiw-item">
                                <h3>{{ trans('sentence.best_coupon') }}</h3>
                                <p>{{ trans('sentence.best_coupon_desc') }}</p>
                            </div>
                            <div class="hiw-item">
                                <h3>{{ trans('sentence.find_promo_code') }}</h3>
                                <p>{{ trans('sentence.find_promo_code_desc') }}</p>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
            <!-- How it works section end here -->

            <!-- About us section start here -->
            @if (!empty($site_wide_data['about_desc']))
                <div class="container">
                    <section class="section">
                        <div class="abouts_wrapper">
                            <div class="img_wrapper">
                                <figure>
                                    <img src="{{ config('app.image_path') }}/build/images/placeholder.png"
                                        data-src="{{ !empty($site_wide_data['about_image']) ? $site_wide_data['about_image'] : config('app.image_path') . '/build/images/hello-team.svg' }}"
                                        width="670" height="420" alt="About Us" />
                                </figure>
                            </div>
                            <div class="about_content">
                                <h2 class="heading">{{ trans('sentence.about_lmc') }}</h2>
                                <p>{!! $site_wide_data['about_desc'] !!}</p>
                            </div>
                        </div>
                    </section>
                </div>
            @endif
            <!-- About us section end here -->
        @endif
    </main>
    <section class="section pbn d-none" style="display:none !important">
        <div class="subscribe">
            <div class="container">
                <p class="title">{{ trans('sentence.subscribe_heading') }}</p>
                <div class="subscribe-searchbar">
                    <input type="email" class="subBoxEmail" data-name="footer" id="1footer" name="subBoxEmail"
                        aria-label="Enter Email" required="" />
                    <label for="1footer" hidden></label>
                    <button type="button" class="submit btn"
                        data-name="footer">{{ trans('sentence.subscribe_btn') }}</button>
                </div>
                <div id="footer" style="width: 100%;margin: 0px;"></div>
                <p class="error footer-error" style="font-size: 15px;margin: 0px;padding: 0px;"></p>
                <p class="subtitle">{{ trans('sentence.privacy_policy_text') }} <a
                        href="{{ config('app.app_path') }}/privacy-policy">{{ trans('sentence.privacy_policy_link') }}</a>.
                </p>
            </div>
        </div>
    </section>
@endsection
