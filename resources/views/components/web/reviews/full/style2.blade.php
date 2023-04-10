
@if( isset($author_reviews) && count($author_reviews) > 0 )
<div class="cardGrid-v2">
    <div class="cardGrid">
        @foreach($author_reviews as $review)
            <div class="cardGrid__item">
                @web_component([ 'postfixes' => 'reviews.minimal.style2','data' => [ 'review' => $review  ] ])@endweb_component
            </div>
        @endforeach
    </div>
</div>
@else
    <div>
        <h4>{{ trans('sentence.blogs_not_found') }}</h4>
    </div>
@endif