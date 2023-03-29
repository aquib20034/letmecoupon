@extends('web.layouts.app')
@section('content')

<main class="main">
    <div class="container">
        <!-- three posts section start here -->
        @if(!empty($featuredBlogs))
            <section class="section threeposts-section padding-bottom-none">
                <div class="threeposts">
                    @if(count($featuredBlogs) > 0)
                        @php
                            $singleFeaturedBlog = $featuredBlogs[0];
                            unset($featuredBlogs[0]);
                        @endphp
                        <div class="col">
                            <a href="{{ config('app.app_path') }}/{{ ($singleFeaturedBlog['slugs']) ? $singleFeaturedBlog['slugs']['slug'] : '' }}" class="threeposts__item threeposts__item-large">
                                <div class="threeposts__bg" style="background-image: url({{ isset($singleFeaturedBlog['blog_image']) ? $singleFeaturedBlog['blog_image'] : config('app.image_path').'/build/images/placeholder.png' }})"></div>
                                <div class="threeposts__contentwrapper">
                                    <div class="threeposts__content">
                                        <h3>{{ $singleFeaturedBlog['categories'][0]['title'] }}</h3>
                                        <h1 class="title">{{ $singleFeaturedBlog['title'] }}</h1>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endif
                    <div class="col">
                        @foreach ($featuredBlogs as $featuredBlog)
                            <a href="{{ config('app.app_path') }}/{{ ($featuredBlog['slugs']) ? $featuredBlog['slugs']['slug'] : '' }}" class="threeposts__item">
                                <div class="threeposts__bg" style="background-image: url({{ isset($featuredBlog['blog_image']) ? $featuredBlog['blog_image'] : config('app.image_path').'/build/images/placeholder.png' }})"></div>
                                <div class="threeposts__contentwrapper">
                                    <div class="threeposts__content">
                                        <h3>{{ $featuredBlog['categories'][0]['title'] }}</h3>
                                        <h1 class="title">{{ $featuredBlog['title'] }}</h1>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
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
                        $categoryNameLink = $arr[1] ;
                    @endphp
                    <a href="{{ config('app.app_path') }}/blog?category={{ $categoryList['slugs']['slug'] }}" class="trending_item" style="background-image: url({{ isset($categoryList['cat_blog_image']) ? $categoryList['cat_blog_image'] : config('app.image_path').'/build/images/placeholder.png' }})">
                        <h1>{!! $categoryList['title'] !!}</h1>
                    </a>
                @endforeach
            </div>
        </section>
        <!-- Trending posts section end here -->

        <!-- Posts with paginations start here  -->
        @if(isset($latestBlog))
            <section class="section padding-top-none padding-bottom-none">
                <div class="threeposts">
                    @if(count($latestBlog) > 0)
                        @php
                            $singleLatestBlog = $latestBlog[0];
                            unset($latestBlog[0]);
                            $i=0;
                        @endphp
                        <div class="col">
                            <a href="{{ config('app.app_path') }}/{{ ($singleLatestBlog['slugs']) ? $singleLatestBlog['slugs']['slug'] : '' }}" class="threeposts__item threeposts__item-large">
                                <div class="threeposts__bg" style="background-image: url({{ isset($singleLatestBlog['blog_image']) ? $singleLatestBlog['blog_image'] : config('app.image_path').'/build/images/placeholder.png' }})"></div>
                                <div class="threeposts__contentwrapper">
                                    <div class="threeposts__content">
                                        <h3>{{ isset($singleLatestBlog['categories'][0]) ? $singleLatestBlog['categories'][0]['title'] : '' }}</h3>
                                        <h1 class="title">{{ $singleLatestBlog['title'] }}</h1>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col">
                            @foreach($latestBlog as $latestBlg)
                                @php
                                    if($i==2)
                                        break;
                                @endphp
                                <a href="{{ config('app.app_path') }}/{{ ($latestBlg['slugs']) ? $latestBlg['slugs']['slug'] : '' }}" class="threeposts__item">
                                    <div class="threeposts__bg" style="background-image: url({{ isset($latestBlg['blog_image']) ? $latestBlg['blog_image'] : config('app.image_path').'/build/images/placeholder.png' }})"></div>
                                    <div class="threeposts__contentwrapper">
                                        <div class="threeposts__content">
                                            <h3>{{ $latestBlg['categories'][0]['title'] }}</h3>
                                            <h1 class="title">{{ $latestBlg['title'] }}</h1>
                                        </div>
                                    </div>
                                </a>
                                @php $i++; @endphp
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Posts start here  --}}
                @if(count($latestBlog) > 3)
                    <div class="posts_wrapper">
                        <div class="post">
                            @foreach ($latestBlog as $key => $getBlog)
                                @php
                                    if($key<3)
                                        continue;
                                @endphp
                                <a href="{{ config('app.app_path') }}/{{ ($getBlog['slugs']) ? $getBlog['slugs']['slug'] : '' }}" class="post__bg" style="background-image: url({{ isset($getBlog['blog_image']) ? $getBlog['blog_image'] : config('app.image_path').'/build/images/placeholder.png' }})">
                                    <div class="post__content">
                                        <p>{{ $getBlog['categories'][0]['title'] }}</p>
                                        <h1>{{ $getBlog['title'] }}</h1>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
                {{ $latestBlog->links('vendor.pagination.blog') }}
                {{-- Posts end here --}}
            </section>
        @endif
        <!-- Posts with paginations start here  -->
    </div>
</main>

@endsection
