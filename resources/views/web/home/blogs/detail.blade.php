@extends('web.layouts.app')
@section('content')
    <div class="container">
        <div class="section">
            <!-- Breadcrumbs Section Starts Here -->
            <section class="section pd-none onlyDesktop">
                <div class="container-inner">
                    <?php
                    $routes = [["title" => "Home", "path" => config('app.app_path')], ["title" => "All Blogs", "path" => config('app.app_path')."/blogs"], ["title" => "Blog Detail", "path" => ""]];
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
                                        @web_component([ 'postfixes' => 'social.sidebar.style1','data' => [] ])@endweb_component
                                    </div>
                                    <!-- Sidebar Share Via Section Ends Here -->

                                    <!-- Sidebar Meet the Author Section Starts Here -->
                                    <div class="sidebar__section">
                                        @web_component([ 'postfixes' => 'authors.sidebar.style1','data' => [] ])@endweb_component
                                    </div>
                                    <!-- Sidebar Meet the Author Section Ends Here -->

                                    <!-- Sidebar Table of Content Section Starts Here -->
                                    {{--<div class="sidebar__section">
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
                                    </div>--}}
                                    <!-- Sidebar Table of Content Section Ends Here -->

                                    <!-- Sidebar Related Categories Section Starts Here -->
                                    <div class="sidebar__section">
                                        @web_component([ 'postfixes' => 'categories.sidebar.style2','data' => [] ])@endweb_component
                                    </div>
                                    <!-- Sidebar Related Categories Section Ends Here -->

                                    <!-- Sidebar Related Stores Section Starts Here -->
                                    <div class="sidebar__section onlyLargeDesktop">
                                        @web_component([ 'postfixes' => 'stores.sidebar.style2','data' => [] ])@endweb_component
                                    </div>
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
                                            All you need to know about the
                                            best rubber work boots
                                        </h1>
                                    </div>

                                    <div class="blogInner__date">
                                        <span>
                                            Last updated: Dec 9, 2022
                                        </span>
                                    </div>
                                </section>
                                <!-- Intro Section Ends Here -->

                                <!-- Ricttext Content Section Starts Here -->
                                <section class="section">
                                    <div class="richTextContent-v1">
                                        <!-- 1 -->
                                        <figure>
                                            <img src="../../build/images/blog-image-1.webp" alt="Blog">
                                        </figure>

                                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Consequuntur nisi at illo autem excepturi, possimus quasi quo dolorem quisquam rem velit inventore tenetur vel, nihil fugiat. Optio et cum veniam.</p>
                                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Consequuntur nisi at illo autem excepturi, possimus quasi quo dolorem quisquam rem velit inventore tenetur vel, nihil fugiat. Optio et cum veniam.</p>
                                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Consequuntur nisi at illo autem excepturi, possimus quasi quo dolorem quisquam rem velit inventore tenetur vel, nihil fugiat. Optio et cum veniam.</p>

                                        <!-- 2 -->
                                        <h2>Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi placeat quas distinctio iure?</h2>
                                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Consequuntur nisi at illo autem excepturi, possimus quasi quo dolorem quisquam rem velit inventore tenetur vel, nihil fugiat. Optio et cum veniam.</p>

                                        <figure>
                                            <img src="../../build/images/blog-image-1.webp" alt="Blog">
                                        </figure>

                                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Consequuntur nisi at illo autem excepturi, possimus quasi quo dolorem quisquam rem velit inventore tenetur vel, nihil fugiat. Optio et cum veniam.</p>
                                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Consequuntur nisi at illo autem excepturi, possimus quasi quo dolorem quisquam rem velit inventore tenetur vel, nihil fugiat. Optio et cum veniam.</p>
                                        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Consequuntur nisi at illo autem excepturi, possimus quasi quo dolorem quisquam rem velit inventore tenetur vel, nihil fugiat. Optio et cum veniam.</p>

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

                                        <!-- 3 -->
                                        <div>
                                            <?php //include('../components/DiscountCard/Style2/index.php'); ?>
                                            @web_component([ 'postfixes' => 'coupon.minimal.style1','data' => [] ])@endweb_component
                                        </div>

                                        <!-- 4 -->
                                        <div class="blogDetailLeftCard">
                                            <figure class="left">
                                                <img src="../../build/images/blog-image-1.webp" alt="Blog">
                                            </figure>

                                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Consequuntur nisi at illo autem excepturi, possimus quasi quo dolorem quisquam rem velit inventore tenetur vel, nihil fugiat. Optio et cum veniam.</p>
                                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Consequuntur nisi at illo autem excepturi, possimus quasi quo dolorem quisquam rem velit inventore tenetur vel, nihil fugiat. Optio et cum veniam.</p>
                                            <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Consequuntur nisi at illo autem excepturi, possimus quasi quo dolorem quisquam rem velit inventore tenetur vel, nihil fugiat. Optio et cum veniam.</p>

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

                                        <!-- 5 -->
                                        <div>
                                            <?php
                                            $isDeal = 1;
                                            $isExpired = 0;

                                            // if ($i % 2 === 0) {
                                            //     $isDeal = 0;
                                            // }
                                            ?>
                                            <?php //include('../components/DiscountCard/Style2/index.php'); ?>
                                            @web_component([ 'postfixes' => 'coupon.minimal.style1','data' => [] ])@endweb_component
                                        </div>

                                        <!-- 6 -->
                                        <!-- Newsletter v2 Section Starts Here -->
                                        <section class="section">
                                            <?php //include('../components/NewsLetterForm/Style2/index.php'); ?>
                                            @web_component([ 'postfixes' => 'newsletter.style2','data' => [] ])@endweb_component
                                        </section>
                                        <!-- Newsletter v2 Section Starts Here -->

                                        <!-- 7 -->
                                        <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe, sunt.</h3>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem non odit, sunt unde doloremque inventore, possimus culpa hic, at suscipit voluptatem reiciendis reprehenderit. Dolor vel explicabo libero magnam, ratione sapiente!</p>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem non odit, sunt unde doloremque inventore, possimus culpa hic, at suscipit voluptatem reiciendis reprehenderit. Dolor vel explicabo libero magnam, ratione sapiente!</p>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem non odit, sunt unde doloremque inventore, possimus culpa hic, at suscipit voluptatem reiciendis reprehenderit. Dolor vel explicabo libero magnam, ratione sapiente!</p>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem non odit, sunt unde doloremque inventore, possimus culpa hic, at suscipit voluptatem reiciendis reprehenderit. Dolor vel explicabo libero magnam, ratione sapiente!</p>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem non odit, sunt unde doloremque inventore, possimus culpa hic, at suscipit voluptatem reiciendis reprehenderit. Dolor vel explicabo libero magnam, ratione sapiente!</p>

                                        <!-- 8 -->
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
                                                @web_component([ 'postfixes' => 'coupon.minimal.style2','data' => [] ])@endweb_component
                                            <?php } ?>
                                        </div>
                                        <!-- 1st Coupons Grid Section Ends Here -->

                                        <!-- 9 -->
                                        <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe, sunt.</h3>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem non odit, sunt unde doloremque inventore, possimus culpa hic, at suscipit voluptatem reiciendis reprehenderit. Dolor vel explicabo libero magnam, ratione sapiente!</p>

                                        <!-- 10 -->
                                        <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe, sunt.</h3>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem non odit, sunt unde doloremque inventore, possimus culpa hic, at suscipit voluptatem reiciendis reprehenderit. Dolor vel explicabo libero magnam, ratione sapiente!</p>

                                        <!-- 11 -->
                                        <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe, sunt.</h3>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem non odit, sunt unde doloremque inventore, possimus culpa hic, at suscipit voluptatem reiciendis reprehenderit. Dolor vel explicabo libero magnam, ratione sapiente!</p>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem non odit, sunt unde doloremque inventore, possimus culpa hic, at suscipit voluptatem reiciendis reprehenderit. Dolor vel explicabo libero magnam, ratione sapiente!</p>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem non odit, sunt unde doloremque inventore, possimus culpa hic, at suscipit voluptatem reiciendis reprehenderit. Dolor vel explicabo libero magnam, ratione sapiente!</p>

                                        <!-- 12 -->
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
                                                @web_component([ 'postfixes' => 'coupon.minimal.style2','data' => [] ])@endweb_component
                                            <?php } ?>
                                        </div>
                                        <!-- 2nd Coupons Grid Section Ends Here -->

                                        <!-- 13 -->
                                        <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe, sunt.</h3>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem non odit, sunt unde doloremque inventore, possimus culpa hic, at suscipit voluptatem reiciendis reprehenderit. Dolor vel explicabo libero magnam, ratione sapiente!</p>

                                        <!-- 14 -->
                                        <h3>Lorem ipsum dolor sit amet consectetur adipisicing elit. Saepe, sunt.</h3>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem non odit, sunt unde doloremque inventore, possimus culpa hic, at suscipit voluptatem reiciendis reprehenderit. Dolor vel explicabo libero magnam, ratione sapiente!</p>
                                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem non odit, sunt unde doloremque inventore, possimus culpa hic, at suscipit voluptatem reiciendis reprehenderit. Dolor vel explicabo libero magnam, ratione sapiente!</p>
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

            <!-- Recent Blogs Section Starts Here -->
            <section class="section">
                @web_component([ 'postfixes' => 'blogs.recent.style2','data' => [] ])@endweb_component
            </section>
            <!-- Recent Blogs Section Ends Here -->
        </div>
    </div>
@endsection
