@php
    $reviews_recent = isset($web_settings['reviews_recent'])?unserialize($web_settings['reviews_recent']):[];
@endphp

@if(isset($reviews_recent['status']) && $reviews_recent['status'] == 'on')
<div>
    <h2 class="heading-1">{{ trans('sentence.recent_reviews') }}</h2>
</div>

@if( isset($latestReviews) && !empty($latestReviews) )
    <div class="cardGrid-v2">
        <div class="cardGrid">
            @foreach($latestReviews as $review)
                <div class="cardGrid__item">
                    @web_component([ 'postfixes' => 'reviews.minimal.style2','data' => ['review' => $review] ])@endweb_component
                </div>
            @endforeach
        </div>
    </div>
@else
    <div>
        <h4>{{ trans('sentence.reviews_not_found') }}</h4>
    </div>
@endif
@endif