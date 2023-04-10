@extends('web.layouts.app')
@section('content')
    <main class="main">
        <div class="container">
            <!-- three posts section start here -->
            <section class="section threeposts-section padding-bottom-none">
                <h1 class="top-heading left bold">{!! html_entity_decode($blogCategory->title) !!}</h1>
                {{-- If featured blogs inside this category was found then render the below code --}}
                @if(!empty($featuredBlogs['blogs'][0]))
                    <div class="threeposts">
                        @if($featuredBlogs['blogs'])
                            @php
                                $singleFeaturedBlog = $featuredBlogs['blogs'][0];
                                unset($featuredBlogs['blogs'][0]);
                            @endphp
                            <div class="col">
                                <a href="{{ config('app.app_path') }}/{{ ($singleFeaturedBlog['slugs']) ? $singleFeaturedBlog['slugs']['slug'] : '' }}" class="threeposts__item threeposts__item-large">
                                    <div class="threeposts__bg" style="background-image: url({{ isset($singleFeaturedBlog['blog_image']) ? $singleFeaturedBlog['blog_image'] : config('app.image_path').'/build/images/placeholder.png' }})"></div>
                                    <div class="threeposts__contentwrapper">
                                        <div class="threeposts__content">
                                            <h3>{{ $blogCategory->title }}</h3>
                                            <h1 class="title">{{ $singleFeaturedBlog['title'] }}</h1>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                        <div class="col">
                            @foreach ($featuredBlogs['blogs'] as $featuredBlog)
                                <a href="{{ config('app.app_path') }}/{{ ($featuredBlog['slugs']) ? $featuredBlog['slugs']['slug'] : '' }}" class="threeposts__item">
                                    <div class="threeposts__bg" style="background-image: url({{ isset($featuredBlog['blog_image']) ? $featuredBlog['blog_image'] : config('app.image_path').'/build/images/placeholder.png' }})"></div>
                                    <div class="threeposts__contentwrapper">
                                        <div class="threeposts__content">
                                            <h3>{{ $blogCategory->title }}</h3>
                                            <h1 class="title">{{ $featuredBlog['title'] }}</h1>
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
                    <a href="{{ config('app.app_path') }}/blog-categories">{{ trans('sentence.blog_view_all_categories') }}</a>
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
                        <a href="{{ config('app.app_path') }}/blog?category={{ $categoryList['slugs']['slug'] }}" class="trending_item" style="background-image: url({{ isset($categoryList['category_image']) ? $categoryList['category_image'] : config('app.image_path').'/build/images/placeholder.png' }})">
                            <h1>{{ $categoryList['title'] }}</h1>
                        </a>
                    @endforeach
                </div>
            </section>
            <!-- Trending posts section end here -->

            <!-- Posts with paginations start here  -->
            @if(!empty($currentCatBlogs))
                <section class="section padding-top-none padding-bottom-none">
                    <!-- Posts start here -->
                    <div class="posts_wrapper">
                        <div class="post">
                            @foreach ($currentCatBlogs as $getBlog)
                                <a href="{{ config('app.app_path') }}/{{ ($getBlog['slugs']) ? $getBlog['slugs']['slug'] : '' }}" class="post__bg" style="background-image: url({{ isset($getBlog['blog_image']) ? $getBlog['blog_image'] : config('app.image_path').'/build/images/placeholder.png' }})">
                                    <div class="post__content">
                                        <p>{{ $blogCategory->title }}</p>
                                        <h1>{{ $getBlog['title'] }}</h1>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    {!! $currentCatBlogs->appends(request()->query())->links('vendor.pagination.blog') !!}
                    <!-- Posts end here -->
                </section>
            @endif
            <!-- Posts with paginations start here  -->
        </div>
    </main>
@endsection
