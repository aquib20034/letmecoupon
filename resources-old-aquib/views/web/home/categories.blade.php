@extends('web.layouts.app')
@section('content')
    <div class="container">
        <div class="section">
            <!-- Breadcrumbs Section Starts Here -->
            <section class="section pd-none onlyDesktop">
                <div class="container-inner">
                <?php
                    $routes = [["title" => "Home", "path" => config('app.app_path')], ["title" => "All Categories", "path" => config('app.app_path')."/categories"]];
                    //include('../components/Breadcrumbs/Style1/index.php');
                    ?>
                    @web_component([ 'postfixes' => 'breadcrumbs.style1','data' => ['routes' => $routes] ])@endweb_component
                </div>
            </section>
            <!-- Breadcrumbs Section Ends Here -->

            <!-- All Categories Listing Section Starts Here -->
            <div class="section">
                <div class="container-inner">
                    <div>
                        <h2 class="heading-1 primary">All Categories</h2>
                    </div>

                    <div class="popularListing-v1">
                        <div class="popularListing popularListing--grid-1">
                            <div class="popularListing__wrapper">
                                <div class="popularListing__content">
                                    <ul class="popularListing__list">
                                        <?php for ($i = 1; $i <= 20; $i++) {
                                        ?>
                                            <?php $variant = '1'; ?>
                                            <li class="popularListing__listItem">
                                                <?php //include('../components/Cards/Style4/index.php'); ?>
                                                @web_component([ 'postfixes' => 'categories.minimal.style2','data' => [] ])@endweb_component
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>

                                    <div class="popularListing__gridCta onlyMobile">
                                        <a href="#" class="btn-1" aria-label="View All">View All</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- All Categories Listing Section Ends Here -->

            <!-- Popular Stores & Brands Section Starts Here -->
            <section class="section">
                <div class="popularListing-v1">
                    <div class="popularListing">
                        <div class="popularListing__wrapper">
                            <div class="popularListing__header">
                                <div>
                                    <h2 class="heading-1 m-0">Popular Stores & Brands</h2>
                                </div>

                                <div>
                                    <a href="#" class="btn-1 responsive" aria-label="View All">View All</a>
                                </div>
                            </div>

                            <div class="popularListing__content">
                                <ul class="popularListing__list" onmousedown="mouseDownHandler(this, event)" onmouseup="mouseUpHandler(this)" ontouchend="mouseUpHandler(this)" ontouchstart="mouseDownHandler(this, event)">
                                    <?php for ($i = 1; $i <= 10; $i++) {
                                    ?>
                                        <?php $variant = '2'; ?>
                                        <li class=" popularListing__listItem">
                                            <?php //include('../components/Cards/Style4/index.php'); ?>
                                            @web_component([ 'postfixes' => 'stores.minimal.style1','data' => [] ])@endweb_component
                                        </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Popular Stores & Brands Section Ends Here -->

            <!-- Newsletter Section Starts Here -->
            <section class="section">
                <?php //include('../components/NewsLetterForm/Style1/index.php'); ?>
                @web_component([ 'postfixes' => 'newsletter.style1','data' => [] ])@endweb_component
            </section>
            <!-- Newsletter Section Starts Here -->

            <!-- Trending Blogs & Reviews Section Starts Here -->
            <section class="section">
                <div class="container-inner">
                    <div>
                        <h2 class="heading-1">Trending Blogs & Reviews</h2>
                    </div>

                    <div class="cardGrid-v1">
                        <div class="cardGrid">
                            <?php for ($i = 0; $i < 5; $i++) {
                            ?>
                                <div class="cardGrid__item <?php echo ($i === 0 ? 'cardGrid__item--vertical' : 'cardGrid__item--horizontal'); ?>">
                                    <?php
                                    // include($i === 0 ?
                                    //     '../components/Cards/Style2/index.php'
                                    //     :
                                    //     '../components/Cards/Style3/index.php'
                                    // );
                                    ?>
                                    @if($i === 0)
                                        @web_component([ 'postfixes' => 'blogs.minimal.style1','data' => [] ])@endweb_component
                                    @else
                                        @web_component([ 'postfixes' => 'blogs.minimal.style2','data' => [] ])@endweb_component
                                    @endif
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Trending Blogs & Reviews Section Ends Here -->

            <!-- Popular Reviews Section Starts Here -->
            <section class="section">
                <div class="container-inner">
                    <div>
                        <h2 class="heading-1">Popular Reviews</h2>
                    </div>

                    <div class="cardGrid-v1">
                        <div class="cardGrid">
                            <?php for ($i = 0; $i < 6; $i++) {
                            ?>
                                <div class="cardGrid__item">
                                    <?php //include('../components/Cards/Style3/index.php'); ?>
                                    @web_component([ 'postfixes' => 'reviews.minimal.style2','data' => [] ])@endweb_component
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Popular Reviews Section Ends Here -->
        </div>
    </div>
@endsection
