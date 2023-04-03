@extends('web.layouts.app')
@section('content')
<div class="container-fluid">
    <!-- ***************************** -->
    <!-- About Us Page Content Starts Here -->
    <!-- ***************************** -->
    <div class="contentPage-v1">
        <div class="contentPage contentPage--about">
            <div class="container">
                <div class="section">
                    <!-- Breadcrumbs Section Starts Here -->
                    <section class="section pd-top-none onlyDesktop">
                        <div class="container-inner">
                            <?php
                                $routes = [["title" => "Home", "path" => config('app.app_path')], ["title" => "About Us", "path" => config('app.app_path')."/about-us"]];
                            ?>

                            @web_component([ 'postfixes' => 'breadcrumbs.style1','data' => ['routes' => $routes] ])@endweb_component
                        </div>
                    </section>
                    <!-- Breadcrumbs Section Ends Here -->

                    <!-- About Us Content Section Starts Here -->
                    <section class="section">
                        <div class="container-inner">
                            <div class="contentPage__title">
                                <h1 class="heading-2 primary m-0">About Us</h1>
                            </div>

                            <div class="contentGrid contentGrid--about">
                                <div class="contentBox">
                                    @if (!empty($pageRecord['title']))
                                        <h2>{!! $pageRecord['title'] !!}</h2>
                                    @endif
                                    
                                    @if (!empty($pageRecord['description']))
                                        {!! html_entity_decode($pageRecord['description']) !!}
                                    @endif
                                    
                                </div>

                                <div class="contentBox">
                                    @if (!empty($pageRecord['title']))
                                        <h2>{!! $pageRecord['title'] !!}</h2>
                                    @endif
                                    
                                    @if (!empty($pageRecord['description']))
                                        {!! html_entity_decode($pageRecord['description']) !!}
                                    @endif
                                    
                                </div>

                                <div class="contentBox">
                                    @if (!empty($pageRecord['title']))
                                        <h2>{!! $pageRecord['title'] !!}</h2>
                                    @endif
                                    
                                    @if (!empty($pageRecord['description']))
                                        {!! html_entity_decode($pageRecord['description']) !!}
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- About Us Content Section Ends Here -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
