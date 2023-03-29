@extends('web.layouts.app')
@section('content')
    <main class="main">
        <div class="section">
            <div class="container">
                <div class="cat-heading">
                    <h1>{{ trans('sentence.all_cats') }}</h1>
                </div>
                <div class="flex rowbar">
                    <div class="wide-column small">
                        <section class="section">
                            <div class="category-card-wrp">
                                @if (isset($catsWithChilds))
                                    @foreach ($catsWithChilds as $category)
                                        @if ($category['category_stores_count'] > 0)
                                            <div class="category-card">
                                                <div class="content">
                                                    <h2 class="card-heading mtn">{!! $category['title'] !!}</h2>
                                                    @if (!empty($category['children']) || isset($category['children']))
                                                        <div class="similar-store no-border">
                                                            <ul>
                                                                {{-- @foreach ($category['children'] as $catStore)
                                                                <li><a href="{{ config('app.app_path') }}/{{ $catStore['slugs'] ? $catStore['slugs']['slug'] : '' }}" class="tag">{{ $catStore['name'] }}</a> </li>
                                                            @endforeach --}}
                                                                @foreach ($category['children'] as $child)
                                                                    {{-- <li><a href="{{ config('app.app_path') }}/{{ $category['slugs']['slug'] }}/{{ $child['slug'] ? $child['slug'] : '' }}" class="tag">{{ $child['title'] }}</a></li> --}}
                                                                    {{-- <li><a href="{{ config('app.app_path') }}/{{ $child['slug'] ? $child['slug'] : '' }}" class="tag">{{ $child['title'] }}</a></li> --}}
                                                                    <li><a href="{{ config('app.app_path') }}/{{ $child['slug'] ? $child['slug'] : '' }}"
                                                                            class="tag">{!! html_entity_decode($child['title']) !!}</a></li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                    <a href="{{ config('app.app_path') }}/{{ isset($category['slugs']) ? $category['slugs']['slug'] : '#' }}"
                                                        class="see-all">{{ trans('sentence.see_all') }}
                                                        {!! $category['title'] !!}
                                                        {{ trans('sentence.stores_text') }}</a>
                                                </div>
                                                <div class="image-wrp">
                                                    <div class="image">
                                                        <img src="{{ config('app.image_path') }}/build/images/placeholder.png"
                                                            width="160" height="140"
                                                            data-src="{{ isset($category['category_image']) ? $category['category_image'] : config('app.image_path') . '/build/images/placeholder.png' }}"
                                                            alt="{!! $category['title'] !!}" />
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </section>
                    </div>


                    <div class="short-column sticky small">
                        <section class="section">
                            @if (!empty($popularCategories))
                                <div class="similar-store small">
                                    <h2 class="secondary-heading left small">{{ trans('sentence.popular_categories') }}</h2>
                                    <ul>
                                        @foreach ($popularCategories as $category)
                                            @if ($category['category_stores_count'] > 0)
                                                <li><a href="{{ config('app.app_path') }}/{{ isset($category['slugs']) ? $category['slugs']['slug'] : '#' }}"
                                                        class="tag">{!! $category['title'] !!}</a></li>
                                            @endif
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
