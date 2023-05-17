@extends('web.layouts.app')
@section('content')
    <div class="container">
        <div class="section">
            <!-- Breadcrumbs Section Starts Here -->
            <section class="section pd-none onlyDesktop">
                <div class="container-inner">
                <?php
                    $routes = [["title" => "Home", "path" => config('app.app_path')], ["title" => trans('sentence.view_all_blogs'), "path" => config('app.app_path')."/blog"]];
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
                            <div class="twoColumnLayout__shortColumn small onlyLargeDesktop">
                                <!-- Sidebar Starts Here -->
                                <div class="sidebar sticky js-stickySidebar">
                                    <!-- Sidebar Categories Section Starts Here -->
                                    <div class="sidebar__section">
                                        @web_component([ 'postfixes' => 'categories.sidebar.style1','data' => ['categories' => $list, 'module' => 'blog' ] ])@endweb_component
                                    </div>
                                    <!-- Sidebar Categories Section Ends Here -->

                                    <!-- Sidebar Meet the Authors Section Starts Here -->
                                    <div class="sidebar__section">
                                        @web_component([ 'postfixes' => 'authors.sidebar.style1','data' => [ 'authors' => $blog_authors, 'module' => 'blog'] ])@endweb_component
                                    </div>
                                    <!-- Sidebar Meet the Authors Section Ends Here -->
                                </div>
                                <!-- Sidebar Ends Here -->
                            </div>
                            <!-- Short Column Ends Here -->

                            <!-- Wide Column Starts Here -->
                            <div class="twoColumnLayout__wideColumn">
                                @if(isset($category_data))
                                    <!-- Recent Blogs Section Starts Here -->
                                    <section class="section pd-top-none">
                                        @web_component([ 'postfixes' => 'blogs.full.style1','data' => [ 'category_data' => $category_data ] ])@endweb_component
                                    </section>
                                @else
                                    <!-- Popular Blogs Section Starts Here -->
                                    <section class="section pd-top-none">
                                        @web_component([ 'postfixes' => 'blogs.popular.style1','data' => ['popular_blogs' => $popular_blogs] ])@endweb_component
                                    </section>
                                    <!-- Popular Blogs Section Ends Here -->

                                    <!-- Recent Blogs Section Starts Here -->
                                    <section class="section">
                                        @web_component([ 'postfixes' => 'blogs.recent.style1','data' => [ 'recent_blogs' => $recent_blogs ] ])@endweb_component
                                    </section>
                                    <!-- Recent Blogs Section Ends Here -->
                                @endif
                            </div>
                            <!-- Wide Column Ends Here -->
                        </div>
                    </div>
                </div>
            </section>
            <!-- Two Column Layout Section Ends Here -->

            <!-- Newsletter Section Starts Here -->
            <section class="section">
                <?php //include('../components/NewsLetterForm/Style1/index.php'); ?>
                @web_component([ 'postfixes' => 'newsletter.style1','data' => [] ])@endweb_component
            </section>
            <!-- Newsletter Section Starts Here -->

            <!-- Popular Reviews Section Starts Here -->
            <section class="section">
                @web_component([ 'postfixes' => 'reviews.popular.style2','data' => [ 'popular_reviews' => $popular_reviews] ])@endweb_component
            </section>
            <!-- Popular Reviews Section Ends Here -->
        </div>
    </div>
@endsection
