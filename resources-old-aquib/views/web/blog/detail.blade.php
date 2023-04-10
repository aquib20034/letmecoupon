@extends('web.layouts.app')
@section('content')
    <main class="main">
        <div class="section">
            <div class="container">
                <div class="flex rowbar">
                    <div class="wide-column small">
                        <!-- Featured post section starts here -->
                        <div class="featured">
                            <figure>
                                <img src="{{ config('app.image_path') }}/build/images/placeholder.png" data-src="{{ isset($detail['blog_image']) ? $detail['blog_image'] : config('app.image_path').'/build/images/placeholder.png' }}" alt="{{ $detail['title'] }}" />
                            </figure>
                            <div class="featured__content">
                                <h2 class="title">{{ $detail['title'] }}</h2>
                                <p>
                                    @if(isset($detail['categories']))
                                        @foreach($detail['categories'] as $cats)
                                            <a class="cat" href="{{ config('app.app_path') }}/blog?category={{ $cats['slugs']['slug'] }}">{{ $cats['title'] }}</a>
                                        @endforeach
                                    @endif<span class="date">
                                @php
                                    $temp = explode(' ', $detail['created_at']);
                                    $date = date('M, j Y', strtotime($temp[0]));
                                @endphp {{ $date }}</span><span class="author_name">{{ ($detail['user']) ? $detail['user']['name'] : '' }}</span> </p>
                            </div>
                        </div>
                        <!-- Featured post section ends here -->
                        <div class="richtext noPd">
                            <p>{!! html_entity_decode($detail['long_description']) !!}</p>
                        </div>
                    </div>
                    <div class="short-column sticky small">
                        @if(isset($trendingBlogs) && count($trendingBlogs) > 0)
                            <div class="similar-store small">
                                <h2 class="secondary-heading left small">{{ trans('sentence.trending_topics') }}</h2>
                                <ul>
                                    @foreach($trendingBlogs as $item)
                                        <li>
                                            <a href="{{ config('app.app_path') }}/{{ ($item['slugs']) ? $item['slugs']['slug'] : '' }}" class="tag">{{ $item['title'] ?? '' }}</a>
                                        </li>
                                    @endforeach
                                    <li class="all-categories">
                                        <a href="{{ config('app.app_path') }}/blog">{{ trans('sentence.view_all_blogs') }}</a>
                                    </li>
                                </ul>
                            </div>
                        @endif

                        @if(isset($relatedBlog) && count($relatedBlog) > 0)
                            <div class="similar-store small">
                                <h2 class="secondary-heading left small">{{ trans('sentence.related_blog') }}</h2>
                                <ul>
                                    @foreach ($relatedBlog as $relateBlog)
                                        @if($relateBlog['id'] != $detail['id'])
                                            <li>
                                                <a href="{{ config('app.app_path') }}/{{ ($relateBlog['slugs']) ? $relateBlog['slugs']['slug'] : '' }}" class="tag"> <?php echo $relateBlog['title'] ?></a>
                                            </li>
                                        @endif
                                    @endforeach
                                    <li class="all-categories">
                                        <a href="{{ config('app.app_path') }}/blog">{{ trans('sentence.view_all_blogs') }}</a>
                                    </li>
                                </ul>
                            </div>
                        @endif

                        @if(count($list)>0)
                            <div class="similar-store small">
                                <h2 class="secondary-heading left small">{{ trans('sentence.related_topics') }}</h2>
                                @php
                                    $totalCategories = count($list);
                                    $categoryListingOutput = array_slice($list, 0, 10, true);
                                @endphp
                                <ul>
                                    @foreach($categoryListingOutput as $categoryList)
                                        <li>
                                            <a href="{{ config('app.app_path') }}/blog?category={{ $categoryList['slugs']['slug'] }}" class="tag">{{ $categoryList['title'] }}</a>
                                        </li>
                                    @endforeach
                                    <li class="all-categories">
                                        <a href="{{ config('app.app_path') }}/blog-categories">{{ trans('sentence.blog_view_all_categories') }}</a>
                                    </li>
                                </ul>
                            </div>
                        @endif

                        @if($relatedStores->store_details !== null)
                            <div class="similar-store small">
                                <h2 class="secondary-heading left small">{{ trans('sentence.blog_related_brands') }}</h2>
                                <ul>
                                    @foreach($relatedStores->store_details as $relatedStore)
                                        <li> <a href="{{ config('app.app_path') }}/{{ isset($relatedStore['slug']) ? $relatedStore['slug'] : 'javascript:;' }}" class="tag">{{ $relatedStore['name'] }}</a> </li>
                                    @endforeach
                                    <li class="all-categories">
                                        <a href="{{ config('app.app_path') }}/sitemap">{{ trans('sentence.blog_view_all_brands') }}</a>
                                    </li>
                                </ul>
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
        
        <!-- Author section starts here -->
        <div class="section padding-top-none padding-bottom-none">
            <div class="container">
                <div class="author">
                    <div class="author__img">
                        <figure>
                            <img src="{{ config('app.image_path') }}/build/images/author.png" data-src="{{ isset($detail) ? $detail['user']['user_image'] : config('app.image_path').'/build/images/placeholder.png' }}" alt="{{ isset($detail['user']) ? $detail['user']['name'] : '' }}" width="168" height="168" data-src="build/images/author.png" />
                        </figure>
                    </div>
                    <div class="author__content">
                        <h2>{{ ($detail['user']) ? $detail['user']['name'] : '' }}</h2>
                        <p>{!! $detail['user'] ? $detail['user']['short_description'] : '' !!}</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Author section starts end -->

        <!-- Related blog section starts here -->
        @if(!empty($latestBlog))
            <div class="section">
                <div class="container">
                    <div class="related_blogs">
                        <h2 class="top-heading">{{ trans('sentence.you_may_also_like') }}</h2>
                        <div class="blogs_grid">
				            @foreach($latestBlog as $readMoreBlog)
                                @if($readMoreBlog['id'] != $detail['id'])
                                    <a href="{{ config('app.app_path') }}/{{ isset($readMoreBlog['slugs']) ? $readMoreBlog['slugs']['slug'] : 'javascript:;' }}">
                                        <div class="post">
                                            <figure>
                                                <img src="{{config('app.image_path')}}/build/images/placeholder.png" data-src="{{ isset($readMoreBlog['blog_image']) ? $readMoreBlog['blog_image'] : config('app.image_path').'/build/images/placeholder.png' }}" alt="" />
                                            </figure>
                                            <div class="content">
                                                @php
                                                    $postTitle       = substr($readMoreBlog['title'], 0, 68);
                                                    $postTitleLength = strlen($readMoreBlog['title']);
                                                @endphp
                                                <h2>{{ $postTitle }} @if($postTitleLength > 68) ... @endif</h2>
                                                <p>{{ isset($readMoreBlog['categories'][0]['title']) ? $readMoreBlog['categories'][0]['title'] : '' }}</p>
                                            </div>
                                        </div>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <!-- Related blog section ends here -->

        <!-- Leave A Reply Section Starts Here -->
        <div class="section replybox padding-top-none">
            <div class="container">
                <div class="review_section">
                    <h1 class="heading">Leave A Reply</h1>
                    <p>Your email address will not be published. Required fields are marked *</p>
                    <form>
                        <div class="main-input-wrp">
                            <div class="inptWrapr">
                                <input type="text" name="name" placeholder="Full Name" required="" value="">
                            </div>
                            <div class="inptWrapr">
                                <input type="email" name="email" placeholder="Email" required="" value="">
                            </div>
                            <div class="inptWrapr">
                                <input type="number" name="phone" placeholder="Phone" required="" value="">
                            </div>
                        </div>
                        <textarea class="txtAreaFeild" placeholder="Enter your message" name="Message"></textarea>
                        <ul class="styled-checkox-list">
                            <li>
                                <input class="styled-checkbox" id="styled-checkbox-1" type="checkbox" value="value1">
                                <label for="styled-checkbox-1">Save my name, email, and website in this browser for the next time I comment.</label>
                            </li>
                        </ul>
                        <div class="btnWrapr">
                            <button type="submit" class="sbmtBtn">Post Comment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
