@extends('web.layouts.app')
@section('content')
    <main class="main">
        <!-- components/category-banner.scss -->

        <section class="section">
            <div class="container">
                <div class="category-banner">
                    <h1 class="title">{!! empty($headingOne) ? $detail['title'] : $headingOne !!}</h1>
                    <div class="image">
                        <img src="{{ config('app.image_path') }}/build/images/placeholder.png"
                            data-src="{{ isset($detail['category_banner_image']) ? $detail['category_banner_image'] : config('app.image_path') . '/build/images/placeholder.png' }}"
                            alt="category banner" width="1160" height="260">
                    </div>
                </div>
            </div>
        </section>

        @if (isset($featuredStoresFromCategory['categoryStores']) && count($featuredStoresFromCategory['categoryStores']) > 0)
            <section class="section">
                <div class="container">
                    <div class="top-heading left cap">
                        <h2>{{ trans('sentence.cat_featured_brands') }}</h2>
                    </div>
                    <div class="grid-column-9">
                        @foreach ($featuredStoresFromCategory['categoryStores'] as $featuredStore)
                            <a class="brand-box"
                                href="{{ config('app.app_path') }}/{{ isset($featuredStore['slugs']) ? $featuredStore['slugs']['slug'] : '#' }}">
                                <div class="brand-img-box">
                                    <img src="{{ config('app.image_path') }}/build/images/placeholder.png"
                                        data-src="{{ isset($featuredStore['store_image']) ? $featuredStore['store_image'] : config('app.image_path') . '/build/images/placeholder.png' }}"
                                        alt="{!! $featuredStore['name'] !!}" title="{!! $featuredStore['name'] !!}" height="100"
                                        width="100" />
                                </div>
                                <div class="brand-text">
                                    <p>{{ count($featuredStore['storeCoupons']) }} {{ trans('sentence.cat_vouchers') }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        <section class="section">
            <div class="container">
                <div class="top-heading left cap">
                    <h2>{{ trans('sentence.cat_all_store') }} {!! $detail['title'] !!}</h2>
                </div>
                {{-- @dd($detail) --}}
                <div class="flex rowbar">
                    <div class="wide-column small">
                        @if (!empty($detail['categoryStores']))
                            <section class="section">
                                <div class="grid-column-7">
                                    @foreach ($detail['categoryStores'] as $categoryStore)
                                        <a class="brand-box"
                                            href="{{ config('app.app_path') }}/{{ isset($categoryStore['slugs']) ? $categoryStore['slugs']['slug'] : '#' }}">
                                            <div class="brand-img-box">
                                                <img src="{{ config('app.image_path') }}/build/images/placeholder.png"
                                                    data-src="{{ isset($categoryStore['store_image']) ? $categoryStore['store_image'] : config('app.image_path') . '/build/images/placeholder.png' }}"
                                                    alt="brand" height="100" width="100" />
                                            </div>
                                            <div class="brand-text">
                                                <p>{{ $categoryStore->name }}</p>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </section>
                        @endif

                        @if (isset($detail['long_description']))
                            <div class="richtext gray">
                                <h4 class="left">{{ trans('sentence.cat_about') }} {!! $detail['title'] !!}</h4>
                                <p>{!! html_entity_decode($detail['long_description']) !!}</p>
                            </div>
                        @endif
                    </div>
                    <div class="short-column sticky small">
                        <section class="section">
                            @if (!empty($featuredCategories['children']))
                                <div class="similar-store small">
                                    <h2 class="secondary-heading left small">{{ trans('sentence.related_categories') }}
                                    </h2>
                                    <ul>
                                        @foreach ($featuredCategories['children'] as $featuredCategory)
                                            <li><a href="{{ config('app.app_path') }}/{{ isset($featuredCategory['slug']) ? $featuredCategory['slug'] : '#' }}"
                                                    class="tag">{{ $featuredCategory['title'] }}</a></li>
                                        @endforeach
                                        <li class="all-categories">
                                            <a
                                                href="{{ config('app.app_path') }}/category">{{ trans('sentence.view_all_categories') }}</a>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                            @if (!empty($popularStoresFromCategory['categoryStores']))
                                <div class="similar-store small">
                                    <h2 class="secondary-heading left small">{{ trans('sentence.related_stores') }}</h2>
                                    <ul>
                                        @foreach ($popularStoresFromCategory['categoryStores'] as $relatedStore)
                                            <li><a href="{{ config('app.app_path') }}/{{ isset($relatedStore['slugs']) ? $relatedStore['slugs']['slug'] : '#' }}"
                                                    class="tag">{{ $relatedStore['name'] }}</a></li>
                                        @endforeach
                                        <li class="all-categories">
                                            <a
                                                href="{{ config('app.app_path') }}/sitemap">{{ trans('sentence.view_all_stores') }}</a>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        </section>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
