@extends('web.layouts.app')
@section('content')
    <div class="breadcrumb">
        <ul>
            <li>
                <a href="{{ route('home') }}"><i class="lm_home"></i> Home</a>
            </li>
            <li>
                <a href="{{ route('product') }}">{{ trans('sentence.product_detail_page_heading') }}</a>
            </li>
            <li>
                <a href="{{$categoryProducts['slug']}}">{{ $categoryProducts['name'] }}</a>
            </li>
        </ul>
    </div>
    <div class="about-section">
        <div class="flexWrapper">
            <h2>{{ $categoryProducts['title_heading'] }}</h2>
            <div class="prdTextDetail">
                <p>
                    {!! $categoryProducts['description'] !!}
                </p>
            </div>
        </div>
    </div>
    <div class="flexWrapper ftRemMar">
        <div class="contntWrpr">
            @if(!empty($categoryProducts->productCategoryProducts))
                @foreach($categoryProducts->productCategoryProducts as $key => $product)
                    <div class="main-pro-wrap">
                        <div class="pro-wrper">
                            <span class="counter"><?php echo $key +=1; ?></span>
                            @if($product['discount_percent'] !='')
                                <div class="offDet">
                                    <span>{{ $product['discount_percent'] }}</span> OFF
                                </div>
                            @endif
                            <div class="pro-img">
                                <a href="javascript:;"><img src="{{ config('app.image_path') }}/build/images/placeholder.png" data-src="{{ isset($product['product_image']) ? $product['product_image'] : config('app.image_path') . '/build/images/placeholder.png' }}" alt=""></a>
                            </div>
                            <div class="content">
                                <a href="javascript:;" class="title">{{ $product['title'] }}</a>

                                {!! html_entity_decode($product['long_description']) !!}
                                <div data-targetit="box-mreinfo<?php echo $key; ?>" class="more-info">
                                    <a class="box-mreinfo1" href="javascript:;">{{ trans('sentence.product_more_info') }}</a>
                                </div>
                            </div>
                            <div class="rating">
                                <a href="javascript:;" class="title">{{ $product['title'] }}</a>
                                <div class="rating-count">
                                    <span>{{ trans('sentence.product_our_score') }} {{ $product['rating'] }}</span>
                                </div>
                                <div class="amz-logo">
                                    <img src="{{ config('app.image_path') }}/build/images/placeholder.png" data-src="{{ isset($product['additional_image']['url']) ? $product['additional_image']['url'] : config('app.image_path') . '/build/images/placeholder.png' }}" alt="">
                                </div>
                                <div class="link">
                                    <a href="{{ $product['affiliate_url'] }}" target="_blank">{{ trans('sentence.product_check_price') }}</a>
                                </div>
                                <div class="price">
                                    @if($product['discount_price'] !='')
                                        <span class="new">${{ $product['discount_price'] }}</span>
                                    @endif
                                    @if($product['price'] != '')
                                        <span class="old">${{ $product['price'] }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="box-mreinfo<?php echo $key; ?> accordian-panel">
                            {!! html_entity_decode($product['short_description']) !!}
                        </div>
                    </div>
                    <?php if ($key == 1 || $key % 3 == 0 || $loop->last){ ?>
                        @if(!empty($categoryProducts->productAddSpaceProducts))
                            @foreach($categoryProducts->productAddSpaceProducts as $spro)
                                <div class="storeAddSpace">{!! isset($spro['horizontal_script']) ? $spro['horizontal_script'] : '' !!}</div>
                            @endforeach
                        @endif
                    <?php } ?>
                @endforeach
            @endif
        <!--
        <div class="btn-viewall">
            <a href="javascript:;">view all inversion tables</a>
        </div>
-->
        </div>
        <div class="sidCntnt">
            @if(count($categoryProducts->productAddSpaceProducts) > 0)
                <div class="sidePannel storeAddSpace">
                    @foreach($categoryProducts->productAddSpaceProducts as $spro)
                        {!! isset($spro['vertical_script']) ? $spro['vertical_script'] : '' !!}
                    @endforeach
                </div>
            @endif
            <div class="sidePannel">
                <h4>{{ trans('sentence.product_about') }} {{ $categoryProducts['name'] }}</h4>
                <p>{!! $categoryProducts['about_description'] !!}</p>
            </div>

        </div>
    </div>
    <div class="about-section">
        <div class="flexWrapper">
              <h2> {!! $categoryProducts['sub_heading'] !!}</h2>
            {!! html_entity_decode($categoryProducts['long_description']) !!}
        </div>
    </div>
@endsection
