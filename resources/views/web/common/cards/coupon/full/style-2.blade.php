<div class="discountCardStyle2 js-discountCard {{ $coupon['code'] ? 'only-codes' : 'only-deals' }} coupon-box">
    <div @php $isExpired = false; @endphp
        class="discountCard  discountCard--{{ $variant }} {{ $isExpired ? 'discountCard--expired' : 'discountCard--active' }}">
        <div class="discountCard__wrapper">
            <div class="discountCard__image">
                <a href="{{ config('app.app_path') . '/' . $coupon['store']['slugs']['slug'] }}">
                    <figure>
                        <img data-src="{{ isset($coupon['store']) ? $coupon['store']['store_image'] : config('app.image_path') . '/build/images/placeholder.png' }}"
                            alt="{{ isset($coupon['store']) ? $coupon['store']['name'] : '' }}">
                    </figure>
                </a>
            </div>

            <div class="discountCard__content">
                <div class="discountCard__title">
                    <h2>{!! isset($coupon['title']) ? $coupon['title'] : '' !!}</h2>
                </div>

                <div class="discountCard__attributes">
                    <div class="attribute">
                        <div class="attribute__wrapper">
                            <span class="attribute__icon">
                                <i class="x_clock-circle-1"></i>
                            </span>

                            <span class="attribute__key">
                                {{ trans('sentence.expiry') }} &nbsp;
                            </span>
                            @php
                                $expiry = $coupon['on_going'] == 1 ? trans('sentence.exp_on_going') : date('M-j-Y', strtotime($coupon['date_expiry']));
                            @endphp
                            <span class="attribute__value attribute__value--primary">
                                {!! $expiry !!}
                            </span>
                        </div>
                    </div>

                    <div class="attribute">
                        <div class="attribute__wrapper">
                            <span class="attribute__icon">
                                <i class="x_arrow-up-square-1"></i>
                            </span>

                            <span class="attribute__key">
                                {{ trans('sentence.coupon_views') }} &nbsp;
                            </span>

                            <span class="attribute__value attribute__value--primary">
                                {{ $coupon['viewed'] }} Times
                            </span>
                        </div>
                    </div>

                    <div class="attribute">
                        <div class="attribute__wrapper">
                            <span class="attribute__icon attribute__icon--primary">
                                <i class="x_key-square-1"></i>
                            </span>

                            <span class="attribute__value">
                                {{ $coupon['code'] ? 'Code' : 'Deal' }}
                            </span>
                        </div>
                    </div>

                    @if (isset($coupon['verified']) && $coupon['verified'])
                        <div class="attribute">
                            <div class="attribute__wrapper">
                                <span class="attribute__icon attribute__icon--primary">
                                    <i class="x_check-shield-1"></i>
                                </span>

                                <span class="attribute__value">
                                    {{ trans('sentence.verified') }}
                                </span>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="discountCard__cta">
                <a class="baseurlappend" data-id="{{ encrypt($coupon['id']) }}" data-store="{!! !empty($coupon['affiliate_url'])
                    ? addhttps($coupon['affiliate_url'])
                    : (!empty($coupon['store']['affiliate_url'])
                        ? addhttps($coupon['store']['affiliate_url'])
                        : addhttps($coupon['store']['store_url'])) !!}"
                    data-var="{{ $coupon['code'] ? 'copy' : 'deal' }}"
                    aria-label="{{ $coupon['code'] ? trans('sentence.get_code') : trans('sentence.get_deal') }}">
                    <span class="text">
                        {{ $coupon['code'] ? trans('sentence.get_code') : trans('sentence.get_deal') }}
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>
