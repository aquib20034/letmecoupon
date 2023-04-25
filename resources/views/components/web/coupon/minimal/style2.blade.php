@if (isset($coupon) && !empty($coupon))
<div>
    <div class="discountCardStyle2 js-discountCard {{ $coupon['code'] ? 'only-codes' : 'only-deals' }}">
        <div class="discountCard discountCard--active">
            <div class="discountCard__wrapper">
                <div class="discountCard__image__wrapper">
                    <div class="discountCard__image">
                        <figure>
                            <img src="{{ isset($coupon['store']) ? $coupon['store']['store_image'] : config('app.image_path') . '/build/images/placeholder.png' }}" alt="Store Name">
                        </figure>
                    </div>
                </div>

                <div class="discountCard__mid">
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
</div>
@endif