<?php 
// dd($categoryStores[0]['category_stores']);


?>

@extends('web.layouts.app')
@section('content')
    <div class="container">
        <div class="section">
            <!-- Breadcrumbs Section Starts Here -->
            <section class="section pd-none onlyDesktop">
                <div class="container-inner">
                    <?php
                    $routes = [["title" => "Home", "path" => config('app.app_path')], ["title" => "All Categories", "path" => config('app.app_path')."/category"], ["title" => "Category Detail", "path" => ""]];
                    //include('../components/Breadcrumbs/Style1/index.php');
                    ?>
                    @web_component([ 'postfixes' => 'breadcrumbs.style1','data' => ['routes' => $routes] ])@endweb_component
                </div>
            </section>
            <!-- Breadcrumbs Section Ends Here -->

            <!-- Category Inner => All Stores Listing Section Starts Here -->
            <div class="section">
                <div class="container-inner">
                    <div>
                        <h2 class="heading-1 primary">Category {{ isset($detail->title) ? $detail->title : ""}}</h2> 
                        <!-- dynamic title -->
                    </div>

                    <div class="popularListing-v1">
                        <div class="popularListing popularListing--grid-2">
                            <div class="popularListing__wrapper">
                                <div class="popularListing__content">
                                    <ul class="popularListing__list">
                                        @if (isset($categoryStores)) 
                                            @foreach ($categoryStores[0]['category_stores'] as $store)
                                                <?php $variant = '2'; ?>
                                                <li class="popularListing__listItem">
                                                    <?php //include('../components/Cards/Style4/index.php'); ?>
                                                    @web_component([ 'postfixes' => 'stores.minimal.style1','data' => ['variant' => $variant,'store' => $store] ])@endweb_component
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>

                                    <div class="popularListing__gridCta">
                                        <a href="{{ config('app.app_path') }}/{{isset($detail->slug)?$detail->slug:'#'}}" class="btn-1" aria-label="View All">View All</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Category Inner => All Stores Listing Section Ends Here -->

            <!-- Trending Blogs & Reviews Section Starts Here -->
            <section class="section">
                @web_component([ 'postfixes' => 'blogs.trending.style1','data' => ['trendingBlogs'=>$trendingBlogs] ])@endweb_component
            </section>
            <!-- Trending Blogs & Reviews Section Ends Here -->

            <!-- Newsletter Section Starts Here -->
            <section class="section">
                @web_component([ 'postfixes' => 'newsletter.style1','data' => [] ])@endweb_component
            </section>
            <!-- Newsletter Section Starts Here -->

            <!-- Popular Products Section Starts Here -->
            <section class="section">
                <div class="popularListing-v1">
                    <div class="popularListing">
                        <div class="popularListing__wrapper">
                            <div class="popularListing__header">
                                <div>
                                    <h2 class="heading-1 m-0">Popular Products</h2>
                                </div>

                                <div>
                                    <a href="{{ config('app.app_path') }}/sitemap"  class="btn-1 responsive" aria-label="View All">View All</a>
                                </div>
                            </div>

                            <div class="popularListing__content">
                                <ul class="popularListing__list" onmousedown="mouseDownHandler(this, event)" onmouseup="mouseUpHandler(this)" ontouchend="mouseUpHandler(this)" ontouchstart="mouseDownHandler(this, event)">
                                    @if (isset($popularProducts)) 
                                        @foreach ($popularProducts as $product)
                                                <?php $variant = '4'; ?>
                                                <li class=" popularListing__listItem">
                                                    <?php //include('../components/Cards/Style4/index.php'); ?>
                                                    @web_component([ 'postfixes' => 'products.minimal.style1','data' => ['product'=>$product, 'variant'=>$variant] ])@endweb_component
                                                </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Popular Products Section Ends Here -->

            <!-- Popular Reviews Section Starts Here -->
            <section class="section">
                @web_component([ 'postfixes' => 'reviews.popular.style2','data' => ['popularBlogs'=>$popularBlogs] ])@endweb_component
            </section>
            <!-- Popular Reviews Section Ends Here -->
        </div>
    </div>
@endsection
