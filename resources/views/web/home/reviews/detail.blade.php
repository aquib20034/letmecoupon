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
                                        <h2 class="sidebar__heading">
                                            Meet the Author
                                        </h2>

                                        <div class="sidebar__author">
                                            <figure>
                                                <img src="{{ ((isset($detail['user']['user_image'])) && ($detail['user']['user_image']!='')) ? $detail['user']['user_image'] : config('app.image_path') . '/build/images/user-image-1.webp' }}">
                                            </figure>
                                            <h5>{{ isset($detail['user']['name'])?$detail['user']['name']:"" }}</h5>
                                            <p>{{ isset($detail['user']['name'])?$detail['user']['name']:"" }}, {{ isset($detail['user']['short_description'])?$detail['user']['short_description']:"" }}</p>
                                        </div>
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

                            <!-- Wide Column Starts Here -->
                            <div class="twoColumnLayout__wideColumn">
                                <!-- Intro Section Starts Here -->
                                <section class="section pd-none">
                                    <div class="blogInner__heading">
                                        <h1 class="heading-2 primary m-0">
                                            {{isset($detail['title'])?$detail['title']:""}}
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
                                            <img src="{{ ((isset($detail['review_image'])) && ($detail['review_image']!='')) ? $detail['review_image'] : config('app.image_path') . '/build/images/blog-image-1.webp' }}" alt="Review">
                                        </figure>
                                        <p>{!!isset($detail['long_description'])?$detail['long_description']:""!!}</p>
                                        <p>{!!isset($detail['long_description'])?$detail['long_description']:""!!}</p>
                                        <p>{!!isset($detail['long_description'])?$detail['long_description']:""!!}</p>

                                        <!-- 2 -->
                                        <div>
                                            @web_component([ 'postfixes' => 'comparisonTable.style1','data' => [] ])@endweb_component
                                            <?php //include('../components/comparisonTable/Style1/index.php'); ?>
                                        </div>

                                        <!-- 3 -->
                                        <h2>{{isset($detail['title'])?$detail['title']:""}}</h2>
                                        <p>{!!isset($detail['short_description'])?$detail['short_description']:""!!}</p>

                                        <div class="blogDetailLeftCard">
                                            <figure>
                                                <img src="{{ ((isset($detail['review_image'])) && ($detail['review_image']!='')) ? $detail['review_image'] : config('app.image_path') . '/build/images/blog-image-1.webp' }}" alt="Review">
                                            </figure>

                                            <p>{!!isset($detail['short_description'])?$detail['short_description']:""!!}</p>
                                            <p>{!!isset($detail['short_description'])?$detail['short_description']:""!!}</p>
                                            <p>{!!isset($detail['short_description'])?$detail['short_description']:""!!}</p>
                                            
                                            <ul>
                                                <li>
                                                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                                                </li>

                                                <li>
                                                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                                                </li>

                                                <li>
                                                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                                                </li>

                                                <li>
                                                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                                                </li>

                                                <li>
                                                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                                                </li>
                                            </ul>
                                        </div>

                                        <!-- 4 -->
                                        <div>
                                            @web_component([ 'postfixes' => 'productPreview.style1','data' => [] ])@endweb_component
                                            <?php //include('../components/ProductPreview/Style1/index.php'); ?>
                                        </div>

                                        <!-- 5 -->
                                        <div>
                                            <?php //include('../components/DiscountCard/Style2/index.php'); ?>
                                            @web_component([ 'postfixes' => 'coupon.active.style2','data' => [] ])@endweb_component
                                        </div>

                                        <!-- 6 -->
                                        <div class="blogDetailLeftCard">
                                            <figure>
                                                <img src="{{ ((isset($detail['review_image'])) && ($detail['review_image']!='')) ? $detail['review_image'] : config('app.image_path') . '/build/images/blog-image-1.webp' }}" alt="Review">
                                            </figure>

                                            <p>{!!isset($detail['short_description'])?$detail['short_description']:""!!}</p>
                                            <p>{!!isset($detail['short_description'])?$detail['short_description']:""!!}</p>
                                            <p>{!!isset($detail['short_description'])?$detail['short_description']:""!!}</p>

                                            <ul>
                                                <li>
                                                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                                                </li>

                                                <li>
                                                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                                                </li>

                                                <li>
                                                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                                                </li>

                                                <li>
                                                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                                                </li>

                                                <li>
                                                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                                                </li>
                                            </ul>
                                        </div>

                                         <!-- 7 -->
                                         <div>
                                            <?php //include('../components/ComparisonCard/Style1/index.php'); ?>
                                            @web_component([ 'postfixes' => 'comparisonCard.style1','data' => [] ])@endweb_component
                                        </div>

                                        <!-- 8 -->
                                        <div>
                                            <?php //include('../components/DiscountCard/Style2/index.php'); ?>
                                            @web_component([ 'postfixes' => 'coupon.active.style2','data' => [] ])@endweb_component
                                        </div>
                                        
                                        <!-- 9 -->
                                        <!-- Newsletter v2 Section Starts Here -->
                                        <section class="section">
                                            <?php //include('../components/NewsLetterForm/Style2/index.php'); ?>
                                            @web_component([ 'postfixes' => 'newsletter.style2','data' => [] ])@endweb_component
                                        </section>
                                        <!-- Newsletter v2 Section Starts Here -->

                                        <!--10 -->
                                        <h3>{{isset($detail['title'])?$detail['title']:""}}</h3>
                                        <p>{!!isset($detail['short_description'])?$detail['short_description']:""!!}</p>
                                        <p>{!!isset($detail['short_description'])?$detail['short_description']:""!!}</p>
                                        <p>{!!isset($detail['short_description'])?$detail['short_description']:""!!}</p>
                                        <p>{!!isset($detail['short_description'])?$detail['short_description']:""!!}</p>

                                         <!-- 11 -->
                                        <!-- 1st Coupons Grid Section Starts Here -->
                                        <div class="blogInnerGrid">
                                            <?php for ($i = 0; $i < 3; $i++) { ?>
                                                <?php
                                                $isDeal = 1;
                                                $isExpired = 0;

                                                if ($i % 2 === 0) {
                                                    $isDeal = 0;
                                                }
                                                ?>

                                                <?php //include('../components/DiscountCard/Style1/index.php'); ?>
                                                @web_component([ 'postfixes' => 'coupon.active.style3','data' => ['isDeal'=>$isDeal,'isExpired'=>$isExpired] ])@endweb_component
                                            <?php } ?>
                                        </div>
                                        <!-- 1st Coupons Grid Section Ends Here -->

                                             

                                        <!-- 12 -->
                                        <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe, sunt.</h3>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem non odit, sunt unde doloremque inventore, possimus culpa hic, at suscipit voluptatem reiciendis reprehenderit. Dolor vel explicabo libero magnam, ratione sapiente!</p>

                                        <!-- 13 -->
                                        <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe, sunt.</h3>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem non odit, sunt unde doloremque inventore, possimus culpa hic, at suscipit voluptatem reiciendis reprehenderit. Dolor vel explicabo libero magnam, ratione sapiente!</p>

                                        <!-- 14 -->
                                        <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe, sunt.</h3>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem non odit, sunt unde doloremque inventore, possimus culpa hic, at suscipit voluptatem reiciendis reprehenderit. Dolor vel explicabo libero magnam, ratione sapiente!</p>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem non odit, sunt unde doloremque inventore, possimus culpa hic, at suscipit voluptatem reiciendis reprehenderit. Dolor vel explicabo libero magnam, ratione sapiente!</p>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem non odit, sunt unde doloremque inventore, possimus culpa hic, at suscipit voluptatem reiciendis reprehenderit. Dolor vel explicabo libero magnam, ratione sapiente!</p>

                                        <!-- 15 -->
                                        <!-- 2nd Coupons Grid Section Starts Here -->
                                        <div class="blogInnerGrid">
                                            <?php for ($i = 0; $i < 3; $i++) { ?>
                                                <?php
                                                $isDeal = 1;
                                                $isExpired = 0;

                                                if ($i % 2 === 0) {
                                                    $isDeal = 0;
                                                }
                                                ?>

                                                <?php //include('../components/DiscountCard/Style1/index.php'); ?>
                                                @web_component([ 'postfixes' => 'coupon.active.style3','data' => ['isDeal'=>$isDeal,'isExpired'=>$isExpired] ])@endweb_component
                                            <?php } ?>
                                        </div>
                                        <!-- 2nd Coupons Grid Section Ends Here -->

                                        <!-- 16-->
                                        <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe, sunt.</h3>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem non odit, sunt unde doloremque inventore, possimus culpa hic, at suscipit voluptatem reiciendis reprehenderit. Dolor vel explicabo libero magnam, ratione sapiente!</p>

                                        <!-- 17 -->
                                        <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe, sunt.</h3>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem non odit, sunt unde doloremque inventore, possimus culpa hic, at suscipit voluptatem reiciendis reprehenderit. Dolor vel explicabo libero magnam, ratione sapiente!</p>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem non odit, sunt unde doloremque inventore, possimus culpa hic, at suscipit voluptatem reiciendis reprehenderit. Dolor vel explicabo libero magnam, ratione sapiente!</p>
                                       

                                        <!-- 18 -->
                                        <!-- Review Box Section Starts Here -->
                                        <section class="section pd-none">
                                            <?php //include('../components/ReviewBox/Style1/index.php'); ?>
                                            @web_component([ 'postfixes' => 'reviewBox.style1','data' => [] ])@endweb_component

                                        </section>
                                        <!-- Review Box Section Ends Here -->

                                        <!-- 19 -->
                                        <!-- Rating Section Starts Here -->
                                        <section class="section pd-none">
                                            <?php for ($i = 0; $i < 4; $i++) { ?>
                                                <?php //include('../components/Rating/Style1/index.php'); ?>
                                                @web_component([ 'postfixes' => 'rating.style1','data' => [] ])@endweb_component

                                            <?php } ?>
                                        </section>
                                        <!-- Rating Section Ends Here -->
                                        

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

            <!-- Popular Reviews Section Starts Here -->
            <section class="section">
            @web_component([ 'postfixes' => 'reviews.popular.style2','data' => ['popularReviews'=>$popularReviews] ])@endweb_component
            </section>
            <!-- Popular Reviews Section Ends Here -->
        </div>
    </div>
@endsection
