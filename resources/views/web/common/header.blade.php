<?php ob_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">    
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, initial-scale=1.0">
    @php
        //Meta Keywords, Title and Meta Description
        $title = isset($meta['title']) ? $meta['title'] : $site_wide_data['name'];
        $description = isset($meta['description']) ? $meta['description'] : $site_wide_data['meta_description'];
    @endphp
    <meta name="title" content="{{ $title }}">
    <meta name="description" content="{{ $description }}" />

    @if (isset($global_data['primary_color']))
        <!--  Chrome, Firefox OS and Opera -->
        <meta name="theme-color" content="{{ $global_data['primary_color'] }}" />
        <!-- Windows Phone -->
        <meta name="msapplication-navbutton-color" content="{{ $global_data['primary_color'] }}" />
        <!-- iOS Safari -->
        <meta name="apple-mobile-web-app-status-bar-style" content="{{ $global_data['primary_color'] }}" />
    @endif

    <!-- html tags for site -->
    {!! isset($site_wide_data['html_tags']) ? $site_wide_data['html_tags'] : '' !!}
    {!! isset($global_data['site_html_tags']) ? $global_data['site_html_tags'] : '' !!}

    <link rel="icon"
        href="{{ isset($global_data['site_favicon']) ? $global_data['site_favicon'] : config('app.app_image') . '/build/images/favicon.png' }}"
        type="image/x-icon">

    @if (\App::environment('production'))
        <link rel="preload" href="{{ secure_asset('build/css/app/icons.css') }}" as="style"
            onload="this.rel='stylesheet'" crossorigin="anonymous">
        <link rel="preload" href="{{ secure_asset('build/css/app/fonts.css') }}" as="style"
            onload="this.rel='stylesheet'" crossorigin="anonymous">
    @else
        <link rel="preload" href="{{ asset('build/css/app/icons.css') }}" as="style" onload="this.rel='stylesheet'"
            crossorigin="anonymous">
        <link rel="preload" href="{{ asset('build/css/app/fonts.css') }}" as="style" onload="this.rel='stylesheet'"
            crossorigin="anonymous">
    @endif
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" async />
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>{!! $title !!}</title>
    <style>
        <?php
        // if (isset($pageCss)):
        //     $css = asset("build/css/app/pages/$pageCss.css");
        //     readfile("build/css/app/pages/$pageCss.css");
        // else:
        //     $css = asset('build/css/main.css');
        //     readfile('build/css/main.css');
        // endif;
        //readfile('build/css/main.css');
        readfile('build/css/app/main.css');
        if (isset($pageCss)):
            readfile("build/css/app/pages/$pageCss.css");
        endif;
        // if (isset($fullCouponCardCss)):
        //     $css = asset("build/css/app/pages/$fullCouponCardCss.css");
        //     readfile("build/css/app/pages/$fullCouponCardCss.css");
        // endif;
        // if (isset($minimalCouponCardCss)):
        //     $css = asset("build/css/app/pages/$minimalCouponCardCss.css");
        //     readfile("build/css/app/pages/$minimalCouponCardCss.css");
        // endif;
        ?>
    </style>

    <style>
        :root {
            --cms-primary-color: {{ $global_data['primary_color'] }};

            --cms-secondary-color: {{ $global_data['secondary_color'] }};

            --cms-tertiary-color: {{ $global_data['tertiary_color'] }};
        }
    </style>
</head>

<body>
    <div id="root">
        <div class="overlay"></div>
        <!-- <div class="overlay-2"></div> -->
        <!-- to hide the "header-search-component" add $hide_searchbar variable while using -->
        <!-- don't change this class logic -->
        <!--<header class="header @if (Route::currentRouteName() == 'home') hide-searchbar @endif">
            <div class="main-header-bar">
                <div class="container">
                    <div class="flex rowbar10 main-navigation-bar">
                        <a href="{{ config('app.app_path') }}" class="logo">
                            <picture>
                                <img src="{{ config('app.image_path') . '/build/images/placeholder.png' }}"
                                    data-src="{{ !empty($global_data['site_logo']) ? $global_data['site_logo'] : config('app.image_path') . '/build/images/placeholder.png' }}"
                                    width="246" height="50" alt="logo" />
                            </picture>
                        </a>
                        <div class="main-navigation">
                            <div class="sidenav">
                                <ul class="responsive-nav-items">
                                    <li class="close-sidenav">
                                        <i class="x_close"></i>
                                    </li>
                                    <li class="back-wrp hidden">
                                        <i class="x_left store-back"></i>
                                    </li>
                                    <li class="back-wrp">
                                        <i class="x_left cat-back hidden"></i>
                                    </li>
                                    <li class="main-item drop-down-menu">
                                        <a href="{{ config('app.app_path') }}/category"
                                            class="link">{{ trans('sentence.view_all_categories') }}</a>
                                    </li>

                                    <li class="main-item drop-down-menu">
                                        <a href="{{ config('app.app_path') }}/sitemap"
                                            class="link">{{ trans('sentence.view_all_stores') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="actions">
                            <i class="x_menu hidden menu-icon"></i>
                        </div>

                    </div>
                </div>
            </div>
            <div class="search-bar">
                <div class="inner">
                    <div class="search">
                        <i class="x_search"></i>
                        <input type="text" name="main-search" id="searchInput" class="search-field"
                            placeholder="{{ trans('sentence.search_lbl_field') }}" />
                    </div>
                    <div class="predective-search">
                        <ul class="" id="storeResult">
                        </ul>
                    </div>
                </div>
            </div>
        </header>-->
        <div class="container-fluid">
            <div class="headerStyle1 sticky">
                @web_component([ 'postfixes' => 'header.style1','data' => ['global_data' => $global_data, 'socials' => $socials] ])@endweb_component
            </div>
        
