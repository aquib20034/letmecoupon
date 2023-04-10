<div>
    <h2 class="heading-1">Active Coupons & Deals</h2>
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
                
                @if($coupon['date_expiry'] >= date('Y-m-d') )
                @php
                    $count = 1;
                @endphp
                <div class="discountCardStyle1 js-discountCard {{ $coupon['code'] ? 'only-codes' : 'only-deals' }}">
                    <div class="discountCard discountCard--active">
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
                                <a href="" class="{{ $coupon['code'] ? 'dark' : 'light' }}  baseurlappend"
                                data-id="{{ encrypt($coupon['id']) }}" data-store="{!! !empty($coupon['affiliate_url'])
                    ? addhttps($coupon['affiliate_url'])
                    : (!empty($coupon['store']['affiliate_url'])
                        ? addhttps($coupon['store']['affiliate_url'])
                        : addhttps($coupon['store']['store_url'])) !!}"
                    data-var="{{ $coupon['code'] ? 'copy' : 'deal' }}"
                                
                                aria-label="{{ $coupon['code'] ? trans('sentence.get_code') : trans('sentence.get_deal') }}">{{ $coupon['code'] ? trans('sentence.get_code') : trans('sentence.get_deal') }}</a>
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