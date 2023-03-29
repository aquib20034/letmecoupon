@extends('web.layouts.app')
<style>
    .flashBanners {
        margin: 10px 10px 30px;
    }

    .flashBanners>div iframe {
        width: 100%;
    }
</style>
@section('content')
    <main class="main store">
        <div class="container">
            <div class="flex rowbar store-page-wrapper">
                <div class="wide-column small pbn wide-col-pad">
                    <!-- Store Top Detail Section Appears on mobile Only Ends here -->
                    <div class="section">
                        <div class="grid-column-1 cupnsAdjust coupons-main-wrapper">
                            @php
                                $count = 0;
                                $totalCodes = [];
                                $totalDeals = [];
                                $bestDeal = [];
                                $avgSavings = [];
                                $finalVal = 0;
                                $i = 0;
                            @endphp
                            @if (!empty($detail['coupons']))
                                @foreach ($detail['coupons'] as $key => $coupon)
                                    @php $key +=1; @endphp
                                    @php  @endphp
                                    @if ($coupon['code'] != '')
                                        @php $totalCodes[] = $coupon['id']; @endphp
                                    @else
                                        @php $totalDeals[] = $coupon['id']; @endphp
                                    @endif
                                    @include(
                                        'web.common.cards.coupon.full.' .
                                            $global_data['coupon_card_style_primary'],
                                        ['variant' => 'horizontal']
                                    )
                                    @php
                                        $i++;
                                        $count++;
                                    @endphp
                                @endforeach
                            @else
                                <p>{{ trans('sentence.coupon_not_found') }}</p>
                            @endif
                        </div>
                    </div>

                    @if (!empty($detail['coupons']))
                        <div class="section">
                            <!-- description Components starts here -->
                            <div class="responsive-desc-border">
                                <button class="accordion-button">
                                    {{ trans('sentence.store_desc') }}
                                    <i class="x_down"></i>
                                </button>
                                <div class="description">
                                    <h4 class="top-heading left">{{ trans('sentence.about') }} {!! $detail['title'] !!}</h4>
                                    <div class="section ptn">
                                        <div class="coupon-table">
                                            <h5>{{ trans('sentence.about') }} {!! $detail['title'] !!}
                                                {{ trans('sentence.promo_codes_sales') }}</h5>
                                            <div class="table-scroll">
                                                <table>
                                                    <thead>
                                                        <tr>
                                                            <th><strong>{{ trans('sentence.cp_tbl_desc') }}</strong></th>
                                                            <th><strong>{{ trans('sentence.cp_tbl_detail') }}</strong></th>
                                                            <th><strong>{{ trans('sentence.cp_tbl_end_date') }}</strong>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($detail['coupons'] as $key => $coupon)
                                                            @if ($key == 5)
                                                            @break
                                                        @endif
                                                        @php
                                                            $expiry = $coupon['on_going'] == 1 ? trans('sentence.exp_on_going') : date('M-j-Y', strtotime($coupon['date_expiry']));
                                                        @endphp
                                                        <tr>
                                                            <td>{!! $coupon['title'] !!}</td>
                                                            <td>{!! $coupon['code'] != '' ? substr($coupon['code'], 0, -3) . '*****' : 'No Cod*****' !!}</td>
                                                            <td>{!! $expiry !!}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                @if (!empty($detail['long_description']))
                                    <div class="section">
                                        <div class="store-detail-description">
                                            {!! html_entity_decode($detail['long_description']) !!}
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <!-- description Components Ends here -->
                    </div>
                @endif
            </div>
            <div class="section short-column small no-padding sticky" id="storeHeaderWrp">
                <section class="sidebar-section">
                    <div class="store_rating">
                        {{-- <div class="image">
                                <picture>
                                    <img src="{{config('app.image_path')}}/build/images/placeholder.png" data-src="{{ isset($detail['store_image']) ? $detail['store_image'] : config('app.app_image').'/build/images/placeholder.png' }}" alt="" width="300" height="150" />
                                </picture>
                            </div> --}}
                        <div class="rating-wrp">
                            <div class="rating-numbers-wrp">
                                <form class="rate">
                                    <input type="radio" id="priceline1" name="priceline" value="11">
                                    <label class="full RateActive" for="priceline1">
                                        <i class="x_star"></i>
                                    </label>
                                    <input type="radio" id="priceline2" name="priceline" value="12">
                                    <label class="full RateActive" for="priceline2">
                                        <i class="x_star"></i>
                                    </label>
                                    <input type="radio" id="priceline3" name="priceline" value="13">
                                    <label class="full" for="priceline3">
                                        <i class="x_star"></i>
                                    </label>
                                    <input type="radio" id="priceline4" name="priceline" value="14">
                                    <label class="full" for="priceline4">
                                        <i class="x_star"></i>
                                    </label>
                                    <input type="radio" id="georgina5" name="georgina" value="15">
                                    <label class="full" for="georgina5">
                                        <i class="x_star"></i>
                                    </label>
                                </form>
                                <!-- <p class="rating-numbers no-desktop">
                                        Rated 4 from 13 votes
                                    </p> -->
                            </div>
                            <h1 class="title">{!! $detail['title'] !!}</h1>
                        </div>
                    </div>
                </section>

                <div class="sidebar-section filter-wrapper" id="filterWrapper">
                    <h2 class="title">{{ trans('sentence.filter_by') }}</h2>
                    <div class="sidebar-checkboxes checkboxes-top" id="checkBoxTop">
                        <div class="chBxWr">
                            <span class="checkBox">
                                <input class="checkbox" id="coupon-box-sidebar" data-visibility="coupon-box"
                                    type="radio" name="code" checked>
                                <label for="coupon-box-sidebar">{{ trans('sentence.all') }}
                                    <span>({{ count($detail['coupons']) }})</span></label>
                            </span>
                        </div>
                        <div class="chBxWr">
                            <span class="checkBox">
                                <input class="checkbox" id="only-codes-sidebar" data-visibility="only-codes"
                                    type="radio" name="code">
                                <label for="only-codes-sidebar">{{ trans('sentence.only_codes') }}
                                    <span>({{ count($totalCodes) }})</span></label>
                            </span>
                        </div>
                        <div class="chBxWr">
                            <span class="checkBox">
                                <input class="checkbox" id="only-deals-sidebar" data-visibility="only-deals"
                                    type="radio" name="code">
                                <label for="only-deals-sidebar">{{ trans('sentence.only_deals') }}
                                    <span>({{ count($totalDeals) }})</span></label>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="sidebar-section only-desktop">
                    <h2 class="secondary-heading left">{!! $detail['title'] !!}</h2>
                    <div class="sidebar-about">
                        <p>{!! html_entity_decode($detail['short_description']) !!}</p>
                    </div>
                </div>

                <div class="sidebar-section only-desktop">
                    <h2 class="secondary-heading left">{{ trans('sentence.todays_top') }} {!! $detail['title'] ?? '' !!}
                        {{ trans('sentence.top_promo_code') }}</h2>
                    <div class="sidebar-committed">
                        <ul>
                            <li><span>{{ trans('sentence.total_offers_sidebar') }}</span><i>{{ count($detail['coupons']) }}</i>
                            </li>
                            <li><span>{{ trans('sentence.voucher_codes') }}</span><i>{{ count($totalCodes) }}</i></li>
                            @if (!empty($bestDeal[0]))
                                <li><span>{{ trans('sentence.best_discount') }}</span><i>{{ max($bestDeal) }}{{ trans('sentence.percent_off') }}</i>
                                </li>
                            @endif
                            <li><span>{{ trans('sentence.free_delivery_deals') }}</span><i>{{ count($totalDeals) }}</i>
                            </li>
                            {{-- @if (!empty($avgSavings[0]))<li><span>{{ trans('sentence.avg_savings') }}</span><i>$@php echo array_sum(array_filter($avgSavings))/count(array_filter($avgSavings)); @endphp</i></li>@endif --}}
                            @php
                                if (sizeof($avgSavings) > 0) {
                                    $avgNum = [];
                                    $val = [];
                                    foreach ($avgSavings as $v) {
                                        $ex = explode("$", $v);
                                        $val[] = filter_var($ex[1], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                                    }
                                    echo '<li><span>' . trans('sentence.avg_savings') . "</span><i>$" . number_format(array_sum(array_filter($val)) / count(array_filter($val)), 2) . '</i></li>';
                                }
                            @endphp
                        </ul>
                    </div>
                </div>

                @if (!empty($popularCategories))
                    <div class="similar-store small only-desktop">
                        <h2 class="secondary-heading left">{{ trans('sentence.popular_categories') }}</h2>
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
                    <div class="similar-store small only-desktop">
                        <h2 class="secondary-heading left">{{ trans('sentence.popular_stores') }}</h2>
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
                    <div class="sidebar-section only-desktop">
                        <h2 class="secondary-heading left">{{ trans('sentence.featured_stores') }}</h2>
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
            </div>
        </div>
    </div>
</main>
@endsection
