@extends('web.layouts.app')
@section('content')
    <div class="container">
        <div class="section">
            @if((isset($is_404)) && ($is_404 == true))
                <!-- Error Page Banner Section Starts Here -->
                <section class="section">
                    @web_component([ 'postfixes' => 'errors.style1','data' => [] ])@endweb_component
                </section>
                <!-- Error Page Banner Section Ends Here -->
            @endif

            @if((isset($is_404)) && ($is_404 == false))
                <!-- Banner Section Starts Here -->
                <section class="section">
                    @web_component([ 'postfixes' => 'banner.home.style1','data' => ['banners' => isset($banners)?$banners:[]] ])@endweb_component
                </section>
                <!-- Banner Section Ends Here -->
            @endif

            @if((isset($is_404)) && ($is_404 == false))
                <!-- Blog Slider Section Starts Here -->
                <section class="section">
                    @web_component([ 'postfixes' => 'categories.slider.style1','data' => ['featuredCategories' => isset($featuredCategories)?$featuredCategories:[]] ])@endweb_component
                </section>
                <!-- Blog Slider Section Ends Here -->
            @endif

            <!-- Trending Blogs & Reviews Section Starts Here -->
            <section class="section">
                @web_component([ 'postfixes' => 'blogs.trending.style1','data' => ['trendingBlog' => isset($trendingBlogAndReviews)?$trendingBlogAndReviews:[]] ])@endweb_component
            </section>
            <!-- Trending Blogs & Reviews Section Ends Here -->

            <!-- Popular Categories Section Starts Here -->
            <section class="section">
                @web_component([ 'postfixes' => 'categories.popular.style1','data' => ['popularCategories' => isset($popularCategories)?$popularCategories:[]] ])@endweb_component
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
                @web_component([ 'postfixes' => 'stores.popular.style1','data' => ['popularStores' => isset($popularStores)?$popularStores:[]] ])@endweb_component
            </section>
            <!-- Popular Stores & Brands Section Ends Here -->

            <!-- Popular Reviews Section Starts Here -->
            <section class="section">
                @web_component([ 'postfixes' => 'reviews.popular.style2','data' => ['popular_reviews' => isset($popularReview)?$popularReview:[]] ])@endweb_component
            </section>
            <!-- Popular Reviews Section Ends Here -->
        </div>
    </div>
@endsection
