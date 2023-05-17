@php
    $coupons_expired = isset($web_settings['coupons_expired'])?unserialize($web_settings['coupons_expired']):[];
@endphp

@if(isset($coupons_expired['status']) && $coupons_expired['status'] == 'on')
<div>
    <h2 class="heading-1">Expired Coupons & Deals</h2>
</div>

<div class="storeInnerGrid">
@if (!empty($detail['store_coupons']))
    @php
    $count = 0;
    @endphp
        @foreach ($detail['store_coupons'] as $key => $coupon)
            @php
                $coupon['store'] = [
                    'name' => $detail['name'],
                    'affiliate_url' => $detail['affiliate_url'],
                    'store_url' => $detail['store_url'],
                    'store_image' => $detail['store_image'],
                    'slugs' => $detail['slugs'],
                ];
                @endphp
                
                @if($coupon['date_expiry'] < date('Y-m-d') )
                @php
                    $count = 1;
                @endphp
        <?php //include('../components/DiscountCard/Style2/index.php'); ?>
        <div class="discountCardStyle1 js-discountCard {{ $coupon['code'] ? 'only-codes' : 'only-deals' }}">
            <div class="discountCard discountCard--expired">
                <div class="discountCard__wrapper">
                    <div class="discountCard__image">
                        <figure>
                            <img src="{{ isset($coupon['store']) ? $coupon['store']['store_image'] : config('app.image_path') . '/build/images/placeholder.png' }}" alt="Store Name">
                        </figure>
                    </div>

                    <div>
                        <div class="discountCard__title">
                            <h2>{!! isset($coupon['title']) ? $coupon['title'] : '' !!}</h2>
                        </div>

                        <div class="discountCard__attributes">
                            <div>
                                <div class="tag">
                                    Sale
                                </div>
                            </div>

                            <span>
                                90 Used
                            </span>

                            @if (isset($coupon['verified']) && $coupon['verified'])
                            <span class="success">
                                {{ trans('sentence.verified') }}
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="discountCard__cta">
                        <a href="" 
                        class="{{ $coupon['code'] ? 'dark' : 'light' }}"
                        aria-label="{{ $coupon['code'] ? trans('sentence.get_code') : trans('sentence.get_deal') }}">{{ $coupon['code'] ? trans('sentence.get_code') : trans('sentence.get_deal') }}</a>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
        @if ($count == 0)
        <div class="discountCard__title">
                <h2>{{ trans('sentence.coupon_not_found') }}</h2>
        </div>
        @endif
    @endif
</div>
@endif