<div>
    <h2 class="heading-1 primary">{{ $category_data['title'] }}</h2>
</div>
@if( isset($category_data['reviews']) && count($category_data['reviews']) > 0 )
<div class="cardGrid-v2">
    <div class="cardGrid">
        @foreach($category_data['reviews'] as $review)
            <div class="cardGrid__item">
                @web_component([ 'postfixes' => 'reviews.minimal.style2','data' => [ 'review' => $review  ] ])@endweb_component
            </div>
        @endforeach
    </div>
</div>
@else
    <div>
        <h4>{{ trans('sentence.reviews_not_found') }}</h4>
    </div>
@endif