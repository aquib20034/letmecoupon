<div>
    <h2 class="heading-1">Recent Reviews</h2>
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