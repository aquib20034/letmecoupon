@extends('web.layouts.app')
@section('content')
    <div class="main">
        <!-- Popular Store Starts Here: .scss -->
        <div class="section">
            <div class="container">
                <div class="top-heading">
                    <h3 class="top-heading primary">{{ trans('sentence.sitemap_browse_coupons') }}</h3>
                </div>
                <div class="brand-box-wrapper">
                    @if (!empty($popular))
                        @foreach ($popular as $store)
                            <a class="brand-box" href="{{ $store['slug'] }}">
                                <div class="brand-img-box">
                                    <img src="{{ config('app.app_image') }}/build/images/placeholder.png"
                                        data-src="{{ isset($store['store_image']) ? $store['store_image'] : config('app.app_image') . '/build/images/placeholder.png' }}"
                                        alt="{!! $store['name'] !!}" />
                                </div>
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <!-- Popular Store Ends Here -->

        @php
            $newArray = [];
            if (isset($list) && count($list) > 0) {
                foreach ($list as $item) {
                    $letter = trim(strtolower($item['name'][0]));
            
                    if (ctype_alpha($letter)) {
                        if (isset($newArray[$letter])) {
                            $newArray[$letter][] = $item;
                        } else {
                            $newArray[$letter] = [$item];
                        }
                    } elseif (is_numeric(substr($letter, 0, 1))) {
                        if (isset($newArray['0-9']) && count($newArray['0-9'])) {
                            $newArray['0-9'][] = $item;
                        } else {
                            $newArray['0-9'] = [$item];
                        }
                    } else {
                        $newArray['0-9'][] = $item;
                    }
                }
            }
        @endphp

        @if (!empty($newArray))
            @if (count($newArray) > 0)
                <!-- Store Alphabat Listing Starts Here: store_alphabat_component.scss -->
                <div class="section">
                    <div class="container">
                        <h2 class="top-heading"><span>{{ trans('sentence.all_retailers') }}</h2>
                        <p class="secondary-heading">{{ trans('sentence.sitemap_list_all_stores') }}</p>
                        <div class="alphabat-listing">
                            <ul>
                                @foreach ($newArray as $key => $item)
                                    <li>
                                        <a href="#{{ $key }}">{{ strtoupper($key) }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Store Alphabat Listing Ends Here -->

                <!-- Store listing Starts Here: store_listing_component.scss -->
                <div class="section">
                    <div class="container">
                        <div class="all-store-listing">
                            @foreach ($newArray as $key => $item)
                                <div class="store-box" id="{{ $key }}">
                                    <h3 class="title">{{ strtoupper($key) }}</h3>
                                    <ul class="flex rowbar5">
                                        @foreach ($item as $k => $arrItem)
                                            <li><a
                                                    href="{{ config('app.app_path') }}/{{ $arrItem['slugs'] ? $arrItem['slugs']['slug'] : '' }}">{!! $arrItem['name'] ?? '' !!}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Store listing Ends Here -->
            @endif
        @endif
    </div>
@endsection
