@extends('web.layouts.app')
@section('content')
    <div class="container">
        <div class="section">
            <!-- Breadcrumbs Section Starts Here -->
            <section class="section pd-none onlyDesktop">
                <div class="container-inner">
                    <?php
                    $routes = [["title" => "Home", "path" => config('app.app_path')], ["title" => "Reviews", "path" => config('app.app_path')."/reviews"], ["title" => isset($detail['title'])?$detail['title']:"", "path" => ""]];
                    //include('../components/Breadcrumbs/Style1/index.php');
                    ?>
                    @web_component([ 'postfixes' => 'breadcrumbs.style1','data' => ['routes' => $routes] ])@endweb_component
                </div>
            </section>
            <!-- Breadcrumbs Section Ends Here -->

            <!-- Two Column Layout Section Starts Here -->
            <section class="section">
                <div class="container-inner">
                    <div class="twoColumnLayout-v1">
                        <div class="twoColumnLayout">
                            <!-- Short Column Starts Here -->
                            <div class="twoColumnLayout__shortColumn onlyLargeDesktop">
                                <!-- Sidebar Starts Here -->
                                <div class="sidebar sticky js-stickySidebar onlyDesktop">
                                    <!-- Sidebar Share Via Section Starts Here -->
                                    <div class="sidebar__section">
                                        <h2 class="sidebar__heading">
                                            Share Via
                                        </h2>

                                        <ul class="sidebar__navList">
                                            <li class="sidebar__navItem">
                                                <a href="index.php" class="sidebar__navLink" aria-label="Visit Our Facebook Profile">
                                                    Facebook
                                                </a>
                                            </li>

                                            <li class="sidebar__navItem">
                                                <a href="index.php" class="sidebar__navLink" aria-label="Visit Our Twitter Profile">
                                                    Twitter
                                                </a>
                                            </li>

                                            <li class="sidebar__navItem">
                                                <a href="index.php" class="sidebar__navLink" aria-label="Visit Our Instagram Profile">
                                                    Instagram
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- Sidebar Share Via Section Ends Here -->

                                    <!-- Sidebar Meet the Author Section Starts Here -->
                                    <div class="sidebar__section">
                                        @web_component([ 'postfixes' => 'authors.sidebar.style1','data' => [] ])@endweb_component
                                    </div>
                                    <!-- Sidebar Meet the Author Section Ends Here -->

                                    <!-- Sidebar Table of Content Section Starts Here -->
                                    <div class="sidebar__section">
                                        <h2 class="sidebar__heading">
                                            Table of Content
                                        </h2>

                                        <ul class="sidebar__navList">
                                            <li class="sidebar__navItem">
                                                <a href="index.php" class="sidebar__navLink" aria-label="Visit Our Facebook Profile">
                                                    Facebook
                                                </a>
                                            </li>

                                            <li class="sidebar__navItem">
                                                <a href="index.php" class="sidebar__navLink" aria-label="Visit Our Twitter Profile">
                                                    Twitter
                                                </a>
                                            </li>

                                            <li class="sidebar__navItem">
                                                <a href="index.php" class="sidebar__navLink" aria-label="Visit Our Instagram Profile">
                                                    Instagram
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- Sidebar Table of Content Section Ends Here -->

                                     <!-- Sidebar Related Categories Section Starts Here -->
                                     <div class="sidebar__section">
                                        @web_component([ 'postfixes' => 'categories.sidebar.style1','data' => ['categories'=>$categoryLists] ])@endweb_component
                                    </div>
                                    <!-- Sidebar Related Categories Section Ends Here -->

                                    <!-- Sidebar Related Stores Section Starts Here -->
                                    <div class="sidebar__section onlyLargeDesktop">
                                        <h2 class="sidebar__heading">
                                            Related Stores
                                        </h2>

                                        <div class="popularListing-v1">
                                            <div class="popularListing popularListing--grid-3">
                                                <div class="popularListing__wrapper">
                                                    <div class="popularListing__content">
                                                        <ul class="popularListing__list">
                                                            @if (isset($relatedStores)) 
                                                                @foreach ($relatedStores['store_details'] as $store)
                                                                    <?php $variant = '2'; ?>
                                                                    <li class="popularListing__listItem">
                                                                        <?php //include('../components/Cards/Style4/index.php'); ?>
                                                                        @web_component([ 'postfixes' => 'stores.minimal.style4','data' => ['variant' => $variant,'store' => $store] ])@endweb_component
                                                                    </li>
                                                                @endforeach
                                                            @endif
                                                            
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Sidebar Related Stores Section Ends Here -->
                                </div>
                                <!-- Sidebar Ends Here -->
                            </div>
                            <!-- Short Column Ends Here -->

                           <!-- code here  -->
                        </div>
                    </div>
                </div>
            </section>
            <!-- Two Column Layout Section Ends Here -->

            <!-- Newsletter Section Starts Here -->
            <section class="section">
                @web_component([ 'postfixes' => 'newsletter.style1','data' => [] ])@endweb_component
            </section>
            <!-- Newsletter Section Starts Here -->

            <!-- Popular Reviews Section Starts Here -->
            <section class="section">
            @web_component([ 'postfixes' => 'reviews.popular.style2','data' => ['popularReviews'=>$popularReviews] ])@endweb_component
            </section>
            <!-- Popular Reviews Section Ends Here -->
        </div>
    </div>
@endsection
