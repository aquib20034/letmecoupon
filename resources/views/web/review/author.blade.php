@extends('web.layouts.app')
@section('content')
<div class="container">
    <div class="section">
        <!-- Breadcrumbs Section Starts Here -->
        <section class="section pd-none onlyDesktop">
            <div class="container-inner">
                <?php
                $routes = [["title" => trans('sentence.home'), "path" => config('app.app_path')], ["title" => trans('sentence.all_reviews'), "path" => config('app.app_path')."/review"], ["title" => $author['first_name'].' '.$author['last_name'], "path" => "/review/author/".$author['id']]];
                ?>
                @web_component([ 'postfixes' => 'breadcrumbs.style1','data' => ['routes' => $routes] ])@endweb_component
            </div>
        </section>
        <!-- Breadcrumbs Section Ends Here -->
       
        <section class="section">
            <div class="container-inner">
                <div class="twoColumnLayout-v1">
                    <div class="twoColumnLayout">
                        <div class="twoColumnLayout__shortColumn small">
                            <div class="sidebar sticky js-stickySidebar" style="top: -274px;">
                            <div class="sidebar__section">
                                @web_component([ 'postfixes' => 'authors.sidebar.info.style2','data' => [ 'author' => $author] ])@endweb_component
                            </div>
                        </div>
                    </div>
                    <div class="twoColumnLayout__wideColumn">
                        <section class="section pd-top-none">
                        @web_component([ 'postfixes' => 'reviews.full.style2','data' => ['author_reviews' => $author_reviews] ])@endweb_component
                        </section></div></div>
                </div>
            </div>
        </section>       
       
        <!-- Newsletter Section Starts Here -->
        <section class="section">
            <?php //include('../components/NewsLetterForm/Style1/index.php'); ?>
            @web_component([ 'postfixes' => 'newsletter.style1','data' => [] ])@endweb_component
        </section>
        <!-- Newsletter Section Starts Here -->
    </div>
</div>
    <!-- END BLOG AUTHOR SECTION -->
@endsection
