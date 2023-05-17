@php
    $reviews_popular = isset($web_settings['reviews_popular'])?unserialize($web_settings['reviews_popular']):[];
@endphp

@if(isset($reviews_popular['status']) && $reviews_popular['status'] == 'on')
<div class="container-inner">
    <div>
        <h2 class="heading-1">{{ trans('sentence.popular_reviews') }}</h2>
    </div>

    @if( isset($popular_reviews) && !empty($popular_reviews) )
        <div class="cardGrid-v1">
            <div class="cardGrid">
                @foreach($popular_reviews as $review)
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
</div>
@endif