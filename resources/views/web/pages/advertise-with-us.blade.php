@extends('web.layouts.app')
@section('content')

<div class="container-fluid">
    

    <!-- ***************************** -->
    <!-- Advertise with Us Page Content Starts Here -->
    <!-- ***************************** -->
    <div class="contentPage-v1">
        <div class="contentPage">
            <div class="container">
                <div class="section">
                    <!-- Breadcrumbs Section Starts Here -->
                    <section class="section pd-top-none onlyDesktop">
                        <div class="container-inner">
                            <?php
                                $routes = [["title" => "Home", "path" => config('app.app_path')], ["title" => "Advertise with Us", "path" => config('app.app_path')."/advertise-with-us"]];
                            ?>
                            @web_component([ 'postfixes' => 'breadcrumbs.style1','data' => ['routes' => $routes] ])@endweb_component
                            
                        </div>
                    </section>
                    <!-- Breadcrumbs Section Ends Here -->

                    <!-- Advertise with Us Content Section Starts Here -->
                    <section class="section">
                        <div class="container-inner">
                            <div class="contentPage__title">
                                <h1 class="heading-2 primary m-0">Advertise with Us</h1>
                            </div>

                          

                            <div class="contentGrid">
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
                    <!-- Advertise with Us Content Section Ends Here -->
                </div>
            </div>
        </div>
    </div>
    <!-- ***************************** -->
    <!-- Advertise with Us Page Content Ends Here -->
    <!-- ***************************** -->

</div>

@endsection
