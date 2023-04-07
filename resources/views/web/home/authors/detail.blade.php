@extends('web.layouts.app')
@section('content')
    <div class="container">
        <div class="section">
            <!-- Breadcrumbs Section Starts Here -->
            <section class="section pd-none onlyDesktop">
                <div class="container-inner">
                    <?php
                    $routes = [["title" => "Home", "path" => config('app.app_path')], ["title" => "All Authors", "path" => config('app.app_path')."/authors"], ["title" => "Author", "path" => ""]];
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


                                     <!-- Sidebar Related Categories Section Starts Here -->
                                     <div class="sidebar__section">
                                        @web_component([ 'postfixes' => 'categories.sidebar.style1','data' => ['categories'=>$categoryLists] ])@endweb_component
                                    </div>
                                    <!-- Sidebar Related Categories Section Ends Here -->

                                    <!-- Sidebar Related Stores Section Starts Here -->
                                    <!-- <div class="sidebar__section onlyLargeDesktop">
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
                                    </div> -->
                                    <!-- Sidebar Related Stores Section Ends Here -->
                                </div>
                                <!-- Sidebar Ends Here -->
                            </div>
                            <!-- Short Column Ends Here -->

                            <!-- Wide Column Starts Here -->
                            <div class="twoColumnLayout__wideColumn">
                                <!-- Intro Section Starts Here -->
                                <section class="section pd-none">
                                    <div class="blogInner__heading">
                                        <h1 class="heading-2 primary m-0">
                                        {!! (isset($detail['first_name'])) ? ($detail['first_name']) : "" !!}
                                        {!! (isset($detail['last_name'])) ? ($detail['last_name']) : "" !!}
                                        </h1>
                                    </div>

                                    <div class="blogInner__date">
                                        <span>
                                            Last updated: 
                                            {{ isset(($detail['created_at'])) ? (date('j F Y', strtotime($detail['created_at']) )) : "" }}
                                        </span>
                                    </div>
                                </section>
                                <!-- Intro Section Ends Here -->

                                <!-- Ricttext Content Section Starts Here -->
                                <section class="section">
                                    <div class="richTextContent-v1">
                                        <!-- 1 -->
                                        <figure>
                                            <img src="{{ ((isset($detail['image'])) && ($detail['image']!='')) ? $detail['image'] : config('app.image_path') . '/build/images/blog-image-1.webp' }}" alt="Review">
                                        </figure>
                                        <p>{!!isset($detail['long_description'])?html_entity_decode($detail['long_description']):""!!}</p>
                                        <p>{!!isset($detail['short_description'])?html_entity_decode($detail['short_description']):""!!}</p>

                                      

                                        <!-- 2 -->
                                        <div>
                                            <?php //include('../components/DiscountCard/Style2/index.php'); ?>
                                            @web_component([ 'postfixes' => 'coupon.minimal.style1','data' => [] ])@endweb_component
                                        </div>

                                        
                                    </div>
                                </section>
                                <!-- Richtext Content Section Ends Here -->

                            </div>
                            <!-- Wide Column Ends Here -->
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

          
        </div>
    </div>
@endsection
