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
                                        @web_component([ 'postfixes' => 'social.sidebar.style1','data' => ['detail' => $detail] ])@endweb_component
                                    </div>
                                    <!-- Sidebar Share Via Section Ends Here -->

                                    <!-- Sidebar Meet the Author Section Starts Here -->
                                    <div class="sidebar__section">
                                        @web_component([ 'postfixes' => 'authors.sidebar.info.style1','data' => ['author' => $detail, 'module' => 'review'] ])@endweb_component
                                    </div>
                                    <!-- Sidebar Meet the Author Section Ends Here -->

                                    <!-- Sidebar Related Categories Section Starts Here -->
                                    <div class="sidebar__section">
                                        @web_component([ 'postfixes' => 'categories.sidebar.style2','data' => ['categories'=>$categoryLists, 'module' => 'review'] ])@endweb_component
                                    </div>
                                    <!-- Sidebar Related Categories Section Ends Here -->
                                    
                                    <!-- Sidebar Related Stores Section Starts Here -->
                                    <div class="sidebar__section onlyLargeDesktop">
                                        @web_component([ 'postfixes' => 'stores.sidebar.style2','data' => ['relatedStores' => $relatedStores] ])@endweb_component
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
                                        {!!$detail['long_description'] ? $detail['long_description']:''!!}
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
            @web_component([ 'postfixes' => 'reviews.popular.style2','data' => ['popular_reviews'=>$popularReviews] ])@endweb_component
            </section>
            <!-- Popular Reviews Section Ends Here -->
        </div>
    </div>
@endsection
