<div class="storeInfoCard-v1">
    <div class="storeInfoCard">
        <div class="twoColumnLayout-v1">
            <div class="twoColumnLayout">
                <!-- Short Column Starts Here -->
                <div class="twoColumnLayout__shortColumn">
                    <div class="storeInfoCard__image">
                        <div class="storeInfoCard__image__wrapper">
                            <figure>
                                <img src="{{ isset($store_detail['store_image']) ? $store_detail['store_image'] : config('app.app_image') . '/build/images/placeholder.png' }}" alt="Store Name">
                            </figure>
                        </div>
                    </div>
                </div>
                <!-- Short Column Ends Here -->

                <!-- Wide Column Starts Here -->
                <div class="twoColumnLayout__wideColumn">
                    <div class="storeInfoCard__title">
                        <h1 class="heading-2 primary m-0">
                            {!! isset($store_detail['name'] ) ? $store_detail['name']  : ""!!}
                            {{ isset($site_wide_data['store_heading_one_suffix']) ? $site_wide_data['store_heading_one_suffix'] : "" }}
                        </h1>
                    </div>

                    <div class="storeInfoCard__rating">
                        <!-- <span class="storeInfoCard__rating__attribute storeInfoCard__rating__attribute--count">
                            4.2
                        </span> -->
                        <div class="storeInfoCard__rating__stars">
                            @if (isset($store_detail['rating']) && $store_detail['rating'] <= 5)
                                @for ($i = 1; $i <= 5; $i++)
                                    <span class="icon <?php echo ($i <= $store_detail['rating'] ? 'filled' : 'unfilled'); ?>">
                                        <i class="<?php echo ($i <= $store_detail['rating'] ? 'x_star-filled' : 'x_star-unfilled'); ?>"></i>
                                    </span>
                                @endfor
                            @else
                                @for ($i = 1; $i <= 5; $i++)
                                    <span class="icon 'unfilled">
                                        <i class="x_star-unfilled"></i>
                                    </span>
                                @endfor
                            @endif
                        </div>
                        <span class="storeInfoCard__rating__attribute storeInfoCard__rating__attribute--reviews">
                            ({!! $store_detail['rating'] == '' ? 0: $store_detail['rating'] !!})
                        </span>
                    </div>

                    <div class="storeInfoCard__subTitle">
                        <h2>
                            {!! (isset($store_detail['short_description'])) ? (html_entity_decode($store_detail['short_description'])) : "" !!}
                        </h2>
                    </div>

                    <div class="storeInfoCard__description">
                        <p> 
                            {!! (isset($store_detail['long_description'])) ? (html_entity_decode($store_detail['long_description'])) : "" !!}
                        </p>
                    </div>
                </div>
                <!-- Wide Column Ends Here -->
            </div>
        </div>
    </div>
</div>