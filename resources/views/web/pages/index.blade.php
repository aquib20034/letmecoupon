@extends('web.layouts.app')
@section('content')
    <div class="container-fluid">
        <!-- ***************************** -->
        <!-- Page Content Starts Here -->
        <!-- ***************************** -->
        <div class="contentPage-v1">
            <div class="contentPage contentPage">
                <div class="container">
                    <div class="section">
                        <!-- Breadcrumbs Section Starts Here -->
                        <section class="section pd-top-none onlyDesktop">
                            <div class="container-inner">
                                @php
                                    $page_slug = (isset($pageRecord['slug']) && !empty($pageRecord['slug']))?$pageRecord['slug']:'';
                                    $page_title = (isset($pageRecord['title']) && !empty($pageRecord['title']))?$pageRecord['title']:config('app.name');
                                    $routes = [["title" => "Home", "path" => config('app.app_path')], ["title" => $page_title, "path" => config('app.app_path')."/".$page_slug]];
                                @endphp
                                @web_component([ 'postfixes' => 'breadcrumbs.style1','data' => ['routes' => $routes] ])@endweb_component
                            </div>
                        </section>
                        <!-- Breadcrumbs Section Ends Here -->

                        <!-- Content Section Starts Here -->
                        <section class="section">
                            <div class="container-inner">
                                <div class="contentPage__title">
                                    <h1 class="heading-2 primary m-0">@if (isset($pageRecord['title']) && !empty($pageRecord['title'])){!! $pageRecord['title'] !!}@else{{config('app.name')}}@endif</h1>
                                </div>

                                <div class="contentGrid contentGrid">
                                    <div class="contentBox">
                                        
                                        @if (isset($pageRecord['description']) && !empty($pageRecord['description']))
                                            {!! html_entity_decode($pageRecord['description']) !!}
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                        </section>
                        <!-- Content Section Ends Here -->

                        <!-- Newsletter Section Starts Here -->
                        <section class="section">
                            <?php //include('../components/NewsLetterForm/Style1/index.php'); ?>
                            @web_component([ 'postfixes' => 'newsletter.style1','data' => [] ])@endweb_component
                        </section>
                        <!-- Newsletter Section Starts Here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
