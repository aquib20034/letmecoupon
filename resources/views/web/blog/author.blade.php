@extends('web.layouts.app')
@section('content')
    @php
        $imgHolder = 'data:image/png;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=';
    @endphp
    <div class="overlayCatMenu">
    </div>
    @php
        $totalCategories = count($list);
        $categoryListingOutput = array_slice($list, 0, 6, true);
        $afterSkipCategories = array_slice($list, 6, $totalCategories, true);
    @endphp
    <div class="catSideMenu">
        <div class="Flx topHead" style="background-color: #192d6c">
            <a href="javascript:;" class="logo">
                <picture>
                    <img src="{{ config('app.app_image') }}/build/images/logo.png"
                        data-src="{{ isset($site_wide_data['site_logo']) ? $site_wide_data['site_logo'] : config('app.app_image') . '/build/images/logo.png' }}"
                        alt="logo" />
                </picture>
            </a>
            <div class="close">
                <i class="lm_close" aria-hidden="true" style="color: white;"></i>
            </div>
        </div>
        <ul>
            @foreach ($categoryListingOutput as $categoryList)
                @php
                    $arr = explode('/', $categoryList['slugs']['slug']);
                    $categoryNameLink = $arr[1];
                @endphp
                <li>
                    <a href="{{ config('app.app_path') }}/blog?category={{ $categoryList['slugs']['slug'] }}">
                        <picture>
                            <img src="{{ config('app.image_path') }}/build/images/placeholder.png"
                                data-src="{{ isset($categoryList['category_image']) ? $categoryList['category_image'] : config('app.image_path') . '/build/images/placeholder.png' }}"
                                alt="tavel_category" />
                        </picture>
                        <p>{!! $categoryList['title'] !!}</p>
                    </a>
                </li>
            @endforeach
            <li class="moreCat">
                <a href="javascript:;">
                    <picture>
                        <img src="<?php echo $imgHolder; ?>" data-src="{{ config('app.image_path') }}/build/images/blog/more.png"
                            alt="more_category" />
                    </picture>
                    <p>more</p>
                </a>
                <ul class="catSubMenu">
                    @foreach ($afterSkipCategories as $moreCategories)
                        @php
                            $arr = explode('/', $moreCategories['slugs']['slug']);
                            $categoryNameLink = $arr[1];
                        @endphp
                        <li><a
                                href="{{ config('app.app_path') }}/blog?category={{ $moreCategories['slugs']['slug'] }}">{!! $moreCategories['title'] !!}</a>
                        </li>
                    @endforeach
                </ul>
            </li>
        </ul>
        @php
            $encodeUrl = urlencode(url()->current());
            $title = 'blogs';
        @endphp
        <div class="sclSidePanl">
            <h3>{{ trans('sentence.blog_follow_us_on') }}</h3>
            <a href="{{ isset($site_wide_data['facebook']) ? $site_wide_data['facebook'] : '' }}" target="_blank"
                class="soclicn">
                <i class="lm_facebook"></i>
            </a>
            <a href="{{ isset($site_wide_data['twitter']) ? $site_wide_data['twitter'] : '' }}" target="_blank"
                class="soclicn">
                <i class="lm_twitter"></i>
            </a>
            <a href="{{ isset($site_wide_data['linked_in']) ? $site_wide_data['linked_in'] : '' }}" target="_blank"
                class="soclicn">
                <i class="lm_linkedin"></i>
            </a>
            <a href="{{ isset($site_wide_data['youtube']) ? $site_wide_data['youtube'] : '' }}" target="_blank"
                class="soclicn">
                <i class="lm_youtube"></i>
            </a>
        </div>
    </div>
    <section class="blogWarp" data-bgimage>
        <div class="blgcontainer">
            <!-- blog top category starts here -->
            <div class="catBlogMain">
                <div class="catList">
                    @foreach ($categoryListingOutput as $categoryList)
                        @php
                            $arr = explode('/', $categoryList['slugs']['slug']);
                            $categoryNameLink = $arr[1];
                        @endphp
                        <div class="catBlog">
                            <a href="{{ config('app.app_path') }}/blog?category={{ $categoryList['slugs']['slug'] }}">
                                <picture>
                                    <img src="{{ config('app.image_path') }}/build/images/placeholder.png"
                                        data-src="{{ isset($categoryList['category_image']) ? $categoryList['category_image'] : config('app.image_path') . '/build/images/placeholder.png' }}"
                                        alt="tavel_category" />
                                </picture>
                                <p>{!! $categoryList['title'] !!}</p>
                            </a>
                        </div>
                    @endforeach

                </div>
                <div class="catBlog catMenu">
                    <a href="javascript:;">
                        <picture>
                            <img src="<?php echo $imgHolder; ?>"
                                data-src="{{ config('app.image_path') }}/build/images/blog/more.png" alt="more_category" />
                        </picture>
                        <p>more</p>
                    </a>
                </div>
            </div>

            <!-- blog Author deatial goes here -->
            <div class="authorDet">
                <picture class="image">
                    @if (!empty($blogListing[0]['user']['image']['url']))
                        <img src="{{ $blogListing[0]['user']['image']['url'] }}"
                            data-src="{{ $blogListing[0]['user']['image']['url'] }}" alt="">
                    @else
                        <img src="<?php echo $imgHolder; ?>" data-src="{{ config('app.image_path') }}/build/images/user3.png"
                            alt="">
                    @endif
                </picture>
                <div class="desc">
                    @if (!empty($blogListing[0]['user']['name']))
                        <h1>{{ $blogListing[0]['user']['name'] }}</h1>
                    @else
                        <h1>taylor otwell</h1>
                    @endif

                    @if (!empty($blogListing[0]['user']['short_description']))
                        {!! $blogListing[0]['user']['short_description'] !!}
                    @endif
                </div>
            </div>

        </div>

        <!-- START BLOG AUTHOR SECTION -->
        <div class="blgcontainer">
            <div class="authorPosts">
                {{ csrf_field() }}
                <div id="post_data" class="Flx row">
                    @if (!empty($blogListing))
                        @foreach ($blogListing as $key => $blog)
                            @php
                                $postTitle = substr($blog['title'], 0, 68);
                                $postTitleLength = strlen($blog['title']);
                            @endphp
                            <div class="col-3 standard-post">
                                <div class="inner">
                                    <div class="post-image">
                                        <a href="{{ config('app.app_path') }}/{{ $blog['slugs']['slug'] }}"
                                            class="image">
                                            @if (!empty($blog['blog_image']))
                                                <img src="{{ config('app.image_path') }}/build/images/placeholder.png"
                                                    data-src="{{ $blog['blog_image'] }}" alt="" />
                                            @else
                                                <img src="{{ config('app.image_path') }}/build/images/placeholder.png"
                                                    data-src="{{ config('app.image_path') }}/build/images/blog/imagePlaceHolder336.png"
                                                    alt="" />
                                            @endif
                                        </a>
                                    </div>
                                    <div class="post-details">
                                        <a href="{{ config('app.app_path') }}/{{ $blog['slugs']['slug'] }}">
                                            <div class="category-details">
                                                <span class="cat-icon">
                                                    <img src="{{ $blog['categories'][0]['category_image'] }}"
                                                        data-src="{{ $blog['categories'][0]['category_image'] }}"
                                                        alt="" />
                                                </span>
                                                <div class="category-title">
                                                    <span>{!! $blog['categories'][0]['title'] !!}</span>
                                                </div>
                                            </div>
                                            <div class="post-title">
                                                <h2>{!! $postTitle !!} @if ($postTitleLength > 68)
                                                        ...
                                                    @endif
                                                </h2>
                                            </div>
                                        </a>
                                        <span class="btm-line"></span>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $last_id = $blog['id'];
                            $author_id = $blog['user_id'];
                            if ($key == 2) {
                                break;
                            }
                            ?>
                        @endforeach
                    @endif

                </div>
                @if (count($blogListing) > 3)
                    <div id="load_more">
                        <button type="button" id="blog_load_more_button" blog-author-id="{{ $author_id }}"
                            data-id="{{ $last_id }}" class="blgLoadMore">LOAD MORE</button>
                    </div>
                @endif
            </div>
        </div>
        <!-- END BLOG AUTHOR SECTION -->

    </section>
@endsection
