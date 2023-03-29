@extends('web.layouts.app')
@section('content')
    <main class="main">
        <div class="section">
            <div class="container">
                <div class="cat-heading">
                    <h2>{{ trans('sentence.blog_all_cats') }}</h2>
                </div>
                <div class="flex rowbar">
                    <div class="wide-column small">
                        <section class="section">
                            <div class="category-card-wrp">
                                @if (isset($blogCategory) && count($blogCategory) > 0)
                                    @foreach ($blogCategory as $blog)
                                        <div class="category-card">
                                            <div class="content">
                                                <div class="card-heading mtn">
                                                    <h2>{!! $blog['title'] !!}</h2>
                                                </div>
                                                {{-- @if (!empty($blog['blogs']) || isset($blog['blogs'])) --}}
                                                @if (!empty($blog['children']) || isset($blog['children']))
                                                    <div class="similar-store no-border">
                                                        <ul>
                                                            {{-- @foreach ($blog['blogs'] as $catStore)
                                                                <li><a href="{{ config('app.app_path') }}/{{ $catStore['slugs'] ? $catStore['slugs']['slug'] : '' }}" class="tag">{{ $catStore['title'] }}</a></li>
                                                            @endforeach --}}
                                                            @foreach ($blog['children'] as $child)
                                                                <li><a href="{{ config('app.app_path') }}/blog?category={{ $child['slug'] ? $child['slug'] : '' }}"
                                                                        class="tag">{!! html_entity_decode($child['title']) !!}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                                <a href="{{ config('app.app_path') }}/blog?category={{ isset($blog['slugs']) ? $blog['slugs']['slug'] : '#' }}"
                                                    class="see-all">{{ trans('sentence.see_all') }}{{ $blog['title'] }}{{ trans('sentence.blogs_text') }}</a>
                                            </div>
                                            <div class="image-wrp">
                                                <div class="image">
                                                    <img src="{{ config('app.image_path') }}/build/images/placeholder.png"
                                                        width="160" height="140"
                                                        data-src="{{ isset($blog['category_image']) ? $blog['category_image'] : config('app.image_path') . '/build/images/placeholder.png' }}"
                                                        alt="{!! $blog['title'] !!}" />
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </section>
                    </div>
                    <div class="short-column sticky small">
                        <section class="section">
                            @if (!empty($popularCategories))
                                <div class="similar-store small">
                                    <h2 class="secondary-heading left small">{{ trans('sentence.popular_categories') }}
                                    </h2>
                                    <ul>
                                        @foreach ($popularCategories as $popularCategory)
                                            <li><a href="{{ config('app.app_path') }}/{{ isset($popularCategory['slugs']) ? $popularCategory['slugs']['slug'] : '#' }}"
                                                    class="tag">{!! $popularCategory['title'] !!}</a></li>
                                        @endforeach
                                        <li class="all-categories">
                                            <a
                                                href="{{ config('app.app_path') }}/category">{{ trans('sentence.view_all_categories') }}</a>
                                        </li>
                                    </ul>
                                </div>
                            @endif

                            @if (!empty($popularStores))
                                <div class="similar-store small">
                                    <h2 class="secondary-heading left small">{{ trans('sentence.popular_stores') }}</h2>
                                    <ul>
                                        @foreach ($popularStores as $popularStore)
                                            <li><a href="{{ config('app.app_path') }}/{{ isset($popularStore['slugs']) ? $popularStore['slugs']['slug'] : '#' }}"
                                                    class="tag">{!! $popularStore['name'] !!}</a></li>
                                        @endforeach
                                        <li class="all-categories">
                                            <a
                                                href="{{ config('app.app_path') }}/sitemap">{{ trans('sentence.view_all_stores') }}</a>
                                        </li>
                                    </ul>
                                </div>
                            @endif

                            @if (!empty($featuredStores))
                                <div class="sidebar-section">
                                    <h2 class="title">{{ trans('sentence.featured_stores') }}</h2>
                                    <div class="brand-grid-sm">
                                        @foreach ($featuredStores as $featuredStore)
                                            <a class="brand-box small"
                                                href="{{ config('app.app_path') }}/{{ isset($featuredStore['slugs']) ? $featuredStore['slugs']['slug'] : '#' }}">
                                                <div class="brand-img-box">
                                                    <img src="{{ config('app.image_path') }}/build/images/placeholder.png"
                                                        data-src="{{ isset($featuredStore['store_image']) ? $featuredStore['store_image'] : config('app.app_image') . '/build/images/placeholder.png' }}"
                                                        height="70" width="90" alt="{{ $featuredStore['name'] }}" />
                                                </div>
                                                <div class="brand-text">
                                                    <p>{{ $featuredStore['name'] }}</p>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
