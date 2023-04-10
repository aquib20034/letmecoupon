<nav class="navigation">
    <ul class="navigation__list">
        <li class="navigation__item">
            <div class="navigation__button">
                <span class="text">
                    {{trans('sentence.menu_stores')}}
                </span>
                <span class="icon">
                    <i class="x_arrow-down-1"></i>
                </span>
            </div>

            <div class="navigation__dropdown">
                <div class="dropdown">
                    <div class="dropdown__wrapper">
                        <ul class="dropdown__list">
                            @if(isset($nav_popular_stores) && count($nav_popular_stores) > 0)
                                @foreach($nav_popular_stores as $key => $store)
                                <li class="dropdown__listItem">
                                    <a href="{{ config('app.app_path') }}/{{ isset($store['slugs']) ? $store['slugs']['slug'] : '#' }}" class="title link">
                                        {{ $store['name'] }}
                                    </a>
                                </li>
                                @endforeach
                            @endif

                            <li class="dropdown__listItem">
                                <a href="{{ config('app.app_path') }}/sitemap" class="title link bold" aria-label="{{trans('sentence.browse_all_stores')}}">
                                    {{trans('sentence.browse_all_stores')}}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </li>

        <li class="navigation__item">
            <div class="navigation__button">
                <span class="text">
                    {{trans('sentence.menu_categories')}}
                </span>
                <span class="icon">
                    <i class="x_arrow-down-1"></i>
                </span>
            </div>

            <div class="navigation__dropdown">
                <div class="dropdown">
                    <div class="dropdown__wrapper">
                        <ul class="dropdown__list">
                            @if(isset($nav_popular_categories) && count($nav_popular_categories) > 0)
                                @foreach($nav_popular_categories as $key => $category)
                                    <li class="dropdown__listItem">
                                        <a href="{{ config('app.app_path') }}/{{ isset($category['slugs']) ? $category['slugs']['slug'] : '#' }}" class="title link">
                                            {{$category['title']}}
                                        </a>
                                    </li>
                                @endforeach
                            @endif

                            <li class="dropdown__listItem">
                                <a href="{{ config('app.app_path') }}/category" class="title link bold" aria-label="{{trans('sentence.browse_all_categories')}}">
                                    {{trans('sentence.browse_all_categories')}}
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </li>

        <li class="navigation__item">
            <a href="{{ config('app.app_path') }}/blog" class="navigation__button" aria-label="{{trans('sentence.visit_blogs_page')}}">
                <span class="text">
                    {{trans('sentence.menu_blogs')}}
                </span>
                <!-- <span class="icon">
                    <i class="x_arrow-down-1"></i>
                </span> -->
            </a>
        </li>

        <li class="navigation__item">
            <a href="{{ config('app.app_path') }}/review" class="navigation__button" aria-label="{{trans('sentence.visit_reviews_page')}}">
                <span class="text">
                    {{trans('sentence.menu_reviews')}}
                </span>
                <!-- <span class="icon">
                    <i class="x_arrow-down-1"></i>
                </span> -->
            </a>
        </li>
    </ul>
</nav>