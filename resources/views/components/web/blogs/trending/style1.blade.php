<div class="container-inner">
    <div>
        <h2 class="heading-1">Trending Blogs & Reviews</h2>
    </div>

    <div class="cardGrid-v1">
        <div class="cardGrid">
            <?php  $i=0; ?>
         
            @if (isset($trendingBlogs)) 
                @foreach ($trendingBlogs as $blog)
              
                <div class="cardGrid__item <?php echo ($i === 0 ? 'cardGrid__item--vertical' : 'cardGrid__item--horizontal'); ?>">
                    <?php
                    // include($i === 0 ?
                    //     '../components/Cards/Style2/index.php'
                    //     :
                    //     '../components/Cards/Style3/index.php'
                    // );
                    ?>
                    @if($i == 0)
                 
                        @web_component([ 'postfixes' => 'blogs.minimal.style1','data' => ['blog'=>$blog] ])@endweb_component
                    @else
                 
                        @web_component([ 'postfixes' => 'blogs.minimal.style2','data' => ['blog'=>$blog] ])@endweb_component
                    @endif

                    <?php $i++; ?>
                </div>
                @endforeach
                @endif
        </div>
    </div>
</div>