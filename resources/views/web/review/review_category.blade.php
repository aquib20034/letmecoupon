@extends('web.layouts.app')
@section('content')
    <main class="main">
        <div class="container">
            <!-- three posts section start here -->
            <section class="section threeposts-section padding-bottom-none">
                <h1 class="top-heading left bold">{!! html_entity_decode($reviewCategory->title) !!}</h1>
                {{-- If featured reviews inside this category was found then render the below code --}}
                @if(!empty($featuredReviews['reviews'][0]))
                    <div class="threeposts">
                        @if($featuredReviews['reviews'])
                            @php
                                $singleFeaturedReview = $featuredReviews['reviews'][0];
                                unset($featuredReviews['reviews'][0]);
                            @endphp
                            <div class="col">
                                <a href="{{ config('app.app_path') }}/{{ ($singleFeaturedReview['slugs']) ? $singleFeaturedReview['slugs']['slug'] : '' }}" class="threeposts__item threeposts__item-large">
                                    <div class="threeposts__bg" style="background-image: url({{ isset($singleFeaturedReview['review_image']) ? $singleFeaturedReview['review_image'] : config('app.image_path').'/build/images/placeholder.png' }})"></div>
                                    <div class="threeposts__contentwrapper">
                                        <div class="threeposts__content">
                                            <h3>{{ $reviewCategory->title }}</h3>
                                            <h1 class="title">{{ $singleFeaturedReview['title'] }}</h1>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                        <div class="col">
                            @foreach ($featuredReviews['reviews'] as $featuredReview)
                                <a href="{{ config('app.app_path') }}/{{ ($featuredReview['slugs']) ? $featuredReview['slugs']['slug'] : '' }}" class="threeposts__item">
                                    <div class="threeposts__bg" style="background-image: url({{ isset($featuredReview['review_image']) ? $featuredReview['review_image'] : config('app.image_path').'/build/images/placeholder.png' }})"></div>
                                    <div class="threeposts__contentwrapper">
                                        <div class="threeposts__content">
                                            <h3>{{ $reviewCategory->title }}</h3>
                                            <h1 class="title">{{ $featuredReview['title'] }}</h1>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </section>
            <!-- three posts section end here -->

            <!-- Trending posts section start here -->
            <section class="section trendingpost-section">
                <div class="trending__header">
                    <h2 class="top-heading">{{ trans('sentence.top_trending_topics') }}</h2>
                    <a href="{{ config('app.app_path') }}/review-categories">{{ trans('sentence.review_view_all_categories') }}</a>
                </div>
                <div class="trending_drawer">
                    @php
                        $totalCategories = count($list);
                        $categoryListingOutput = array_slice($list, 0, 6, true);
                    @endphp
                    @foreach($categoryListingOutput as $categoryList)
                        @php
                            $arr = explode('/', $categoryList['slugs']['slug']);
                            $categoryNameLink = $arr[1];
                        @endphp
                        <a href="{{ config('app.app_path') }}/review?category={{ $categoryList['slugs']['slug'] }}" class="trending_item" style="background-image: url({{ isset($categoryList['category_image']) ? $categoryList['category_image'] : config('app.image_path').'/build/images/placeholder.png' }})">
                            <h1>{{ $categoryList['title'] }}</h1>
                        </a>
                    @endforeach
                </div>
            </section>
            <!-- Trending posts section end here -->

            <!-- Posts with paginations start here  -->
            @if(!empty($currentCatReviews))
                <section class="section padding-top-none padding-bottom-none">
                    <!-- Posts start here -->
                    <div class="posts_wrapper">
                        <div class="post">
                            @foreach ($currentCatReviews as $getReview)
                                <a href="{{ config('app.app_path') }}/{{ ($getReview['slugs']) ? $getReview['slugs']['slug'] : '' }}" class="post__bg" style="background-image: url({{ isset($getReview['review_image']) ? $getReview['review_image'] : config('app.image_path').'/build/images/placeholder.png' }})">
                                    <div class="post__content">
                                        <p>{{ $reviewCategory->title }}</p>
                                        <h1>{{ $getReview['title'] }}</h1>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    {!! $currentCatReviews->appends(request()->query())->links('vendor.pagination.review') !!}
                    <!-- Posts end here -->
                </section>
            @endif
            <!-- Posts with paginations start here  -->
        </div>
    </main>
@endsection
