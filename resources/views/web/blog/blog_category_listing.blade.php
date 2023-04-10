@extends('web.layouts.app')
@section('content')
    <div class="container">
        <div class="section">
            <!-- Breadcrumbs Section Starts Here -->
            <section class="section pd-none onlyDesktop">
                <div class="container-inner">
                <?php
                    $routes = [["title" => "Home", "path" => config('app.app_path')], ["title" => trans('sentence.blog_all_cats'), "path" => config('app.app_path')."/blog-categories"]];
                    //include('../components/Breadcrumbs/Style1/index.php');
                    ?>
                    @web_component([ 'postfixes' => 'breadcrumbs.style1','data' => ['routes' => $routes] ])@endweb_component
                </div>
            </section>
            <!-- Breadcrumbs Section Ends Here -->

            
            @if(isset($categories) && count($categories) > 0)
                <!-- All Categories Listing Section Starts Here -->
                <div class="section">
                    <div class="container-inner">
                        <div>
                            <h2 class="heading-1 primary">{{trans('sentence.blog_all_cats')}}</h2>
                        </div>

                        <div class="popularListing-v1">
                            <div class="popularListing popularListing--grid-1">
                                <div class="popularListing__wrapper">
                                    <div class="popularListing__content">
                                        <ul class="popularListing__list">
                                            @foreach($categories as $key => $category)
                                                <li class="popularListing__listItem">
                                                    <?php //include('../components/Cards/Style4/index.php'); ?>
                                                    @web_component([ 'postfixes' => 'blogs.blog-categories.style1','data' => [ 'category' => $category ] ])@endweb_component
                                                </li>
                                            @endforeach
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
            @else
                <div>
                    <h4>{{ trans('sentence.blogs_not_found') }}</h4>
                </div>
            @endif
        </div>


         <!-- Newsletter Section Starts Here -->
         <section class="section">
                <?php //include('../components/NewsLetterForm/Style1/index.php'); ?>
                @web_component([ 'postfixes' => 'newsletter.style1','data' => [] ])@endweb_component
            </section>
            <!-- Newsletter Section Starts Here -->
    </div>
@endsection
