@extends('web.layouts.app')
@section('content')
    <style>
        .pagination {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            list-style: none;
            padding: 0;
            margin: 20px 0;
        }

        .pagination li {
            margin: 0 5px;
        }

        .pagination li a {
            display: block;
            padding: 5px 10px;
            border: 1px solid #ccc;
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }

        .pagination li.active span {
            display: block;
            padding: 5px 10px;
            border: 1px solid #ccc;
            text-decoration: none;
            color: #333;
            font-weight: bold;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .pagination li.disabled span,
        .pagination li.disabled a {
            color: #ccc;
            pointer-events: none;
            cursor: default;
        }

        .pagination li:first-child a,
        .pagination li:last-child a {
            border-radius: 3px;
        }

        .pagination li:first-child a {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .pagination li:last-child a {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        @media only screen and (max-width: 600px) {
            .pagination li {
                margin: 0 2px;
            }
        }
    </style>

    <div class="container">
        <div class="section">
            <!-- Breadcrumbs Section Starts Here -->
            <section class="section pd-none onlyDesktop">
                <div class="container-inner">
                <?php
                    $routes = [["title" => "Home", "path" => config('app.app_path')], ["title" => "All Products", "path" => config('app.app_path')."/products"]];
                    //include('../components/Breadcrumbs/Style1/index.php');
                    ?>
                    @web_component([ 'postfixes' => 'breadcrumbs.style1','data' => ['routes' => $routes] ])@endweb_component
                </div>
            </section>
            <!-- Breadcrumbs Section Ends Here -->

            <!-- All Products Listing Section Starts Here -->
            <div class="section">
                <div class="container-inner">
                    <div>
                        <h2 class="heading-1 primary">All Products</h2>
                    </div>

                    <div class="popularListing-v1">
                        <div class="popularListing popularListing--grid-1">
                            <div class="popularListing__wrapper">
                                <div class="popularListing__content">
                                    <ul class="popularListing__list">
                                        @if (isset($products)) 
                                            @foreach ($products as $product)
                                                    <?php $variant = '1'; ?>
                                                    <li class="popularListing__listItem">
                                                        <?php //include('../components/Cards/Style4/index.php'); ?>
                                                        @web_component([ 'postfixes' => 'products.minimal.style2','data' => ['product'=>$product, 'variant' => $variant] ])@endweb_component
                                                    </li>
                                            @endforeach

                                            

                                        @endif
                                    </ul>
                                    
                                    <div class="popularListing__gridCta onlyMobile">
                                        <a href="{{ config('app.app_path') }}/products" class="btn-1" aria-label="View All">View All</a>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
            
            <!-- All Categories Listing Section Ends Here -->

          

            <!-- Newsletter Section Starts Here -->
            <section class="section">
                <?php //include('../components/NewsLetterForm/Style1/index.php'); ?>
                @web_component([ 'postfixes' => 'newsletter.style1','data' => [] ])@endweb_component
            </section>
            <!-- Newsletter Section Starts Here -->

        </div>
    </div>
@endsection
