<div>
    <h2 class="heading-1 primary">Popular Reviews</h2>
</div>

<div class="cardGrid-v2">
    <div class="cardGrid">
         @if (isset($popularReviews)) 
            @foreach ($popularReviews as $review)
                <div class="cardGrid__item">
                    @web_component([ 'postfixes' => 'reviews.minimal.style2','data' => ['review'=>$review] ])@endweb_component
                </div>
            @endforeach
        @endif
    </div>
</div>