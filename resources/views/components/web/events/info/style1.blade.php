<div class="storeInfoCard-v1">
    <div class="storeInfoCard">
        <div class="twoColumnLayout-v1">
            <div class="twoColumnLayout">
                <!-- Short Column Starts Here -->
                <div class="twoColumnLayout__shortColumn">
                    <div class="storeInfoCard__image">
                        <div class="storeInfoCard__image__wrapper">
                            <figure>
                                <img src="{{ ((isset($detail['event_image'])) && (file_exists($detail['event_image']))) ? $detail['event_image'] : config('app.app_image') . '/build/images/placeholder.png' }}" alt="Store Name">
                            </figure>
                        </div>
                    </div>
                </div>
                <!-- Short Column Ends Here -->

                <!-- Wide Column Starts Here -->
                <div class="twoColumnLayout__wideColumn">
                    <div class="storeInfoCard__title">
                        <h1 class="heading-2 primary m-0"> {!!isset( $detail['title']) ?  $detail['title'] : "" !!}{{ $site_wide_data['store_heading_one_suffix'] }}</h1>
                    </div>

                    <div class="storeInfoCard__rating">
                        <!-- <span class="storeInfoCard__rating__attribute storeInfoCard__rating__attribute--count">
                            4.2
                        </span> -->
                        <div class="storeInfoCard__rating__stars">
                            @if(isset($detail['rating']))
                                @if (isset($detail['rating']) && $detail['rating'] <= 5)
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span class="icon <?php echo ($i <= $detail['rating'] ? 'filled' : 'unfilled'); ?>">
                                            <i class="<?php echo ($i <= $detail['rating'] ? 'x_star-filled' : 'x_star-unfilled'); ?>"></i>
                                        </span>
                                    @endfor
                                @else
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span class="icon 'unfilled">
                                            <i class="x_star-unfilled"></i>
                                        </span>
                                    @endfor
                                @endif
                            @else
                                @for ($i = 1; $i <= 5; $i++)
                                    <span class="icon 'unfilled">
                                        <i class="x_star-unfilled"></i>
                                    </span>
                                @endfor        
                            @endif
                        </div>
                        <span class="storeInfoCard__rating__attribute storeInfoCard__rating__attribute--reviews">
                            ({!! ( (isset($detail['rating']) ) && ($detail['rating'] != '') )  ?$detail['rating'] :0 !!})
                        </span>
                    </div>

                    <div class="storeInfoCard__subTitle">
                        <h2>
                            {!! html_entity_decode($detail['short_description']) !!}
                        </h2>
                    </div>

                    <div class="storeInfoCard__description">
                        <p> {!! html_entity_decode($detail['long_description']) !!}</p>
                    </div>
                </div>
                <!-- Wide Column Ends Here -->
            </div>
        </div>
    </div>
</div>