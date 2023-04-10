@php
    $featuredImage = null;
    
    if (isset($coupon['store']['trending_coupon_image'])):
        $featuredImage = $coupon['store']['trending_coupon_image'];
    endif;
    
    if (!$featuredImage && isset($coupon['store']['categories'][0]['category_coupon_image'])):
        $featuredImage = $coupon['store']['categories'][0]['category_coupon_image'];
    endif;
@endphp

<div class="featureCardStyle4">
    <a class="featureCard featureCard--{{ $variant }} baseurlappendhometrend" data-id="{{ encrypt($coupon['id']) }}"
        data-store="{!! addhttps($redirect_url) !!}" data-var="{{ !empty($coupon['code']) ? 'copy' : 'deal' }}"
        data-couponstore="{{ isset($coupon['store']['slugs']) ? $coupon['store']['slugs']['slug'] : '' }}">

        <div class="featureCard__wrapper">
            <div class="featureCard__images">
                <!-- Display Picture -->
                <div class="featureCard__dpImage">
                    <figure>
                        <img src="{{ config('app.image_path') }}/build/images/placeholder.png"
                            data-src="{{ !empty($coupon['store']) ? $coupon['store']['store_image'] : config('app.image_path') . '/build/images/coupons/placeholder.png)' }}"
                            alt="{{ !empty($coupon['store']) ? $coupon['store']['name'] : 'Store Image' }}">
                    </figure>
                </div>

                <!-- Thumbnail/ Background Image -->
                <div class="featureCard__thumbnail">
                    <figure>
                        <img src="{{ config('app.image_path') }}/build/images/placeholder.png"
                            data-src="{{ $featuredImage ?? config('app.image_path') . '/build/images/coupons/placeholder.png)' }}"
                            alt="{{ !empty($coupon['store']) ? $coupon['store']['name'] : 'Featured Image' }}">
                    </figure>
                </div>
            </div>

            <!-- Typography -->
            <div class="featureCard__content">
                <h2 class="featureCard__heading">
                    {{ $coupon['title'] }}
                </h2>
            </div>
        </div>
    </a>
</div>
