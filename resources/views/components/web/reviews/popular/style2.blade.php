<div class="container-inner">
    <div>
        <h2 class="heading-1">Popular Reviews</h2>
    </div>

    <div class="cardGrid-v1">
        <div class="cardGrid">
            @if (isset($popularBlogs)) 
                @foreach ($popularBlogs as $blog)
              
                    <div class="cardGrid__item">
                        <?php //include('../components/Cards/Style3/index.php'); ?>
                        @web_component([ 'postfixes' => 'reviews.minimal.style2','data' => ['blog'=>$blog] ])@endweb_component
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>