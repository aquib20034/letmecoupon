<div class="container-inner">
    <div>
        <h2 class="heading-1">Popular Reviews</h2>
    </div>

    <div class="cardGrid-v1">
        <div class="cardGrid">
            @if (isset($popularReviews)) 
                @foreach ($popularReviews as $review)
              
                    <div class="cardGrid__item">
                        <?php //include('../components/Cards/Style3/index.php'); ?>
                        @web_component([ 'postfixes' => 'reviews.minimal.style2','data' => ['review'=>$review] ])@endweb_component
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>