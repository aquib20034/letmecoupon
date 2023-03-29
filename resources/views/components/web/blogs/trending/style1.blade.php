<div class="container-inner">
    <div>
        <h2 class="heading-1">Trending Blogs & Reviews</h2>
    </div>

    <div class="cardGrid-v1">
        <div class="cardGrid">
            <?php for ($i = 0; $i < 5; $i++) {
            ?>
                <div class="cardGrid__item <?php echo ($i === 0 ? 'cardGrid__item--vertical' : 'cardGrid__item--horizontal'); ?>">
                    <?php
                    // include($i === 0 ?
                    //     '../components/Cards/Style2/index.php'
                    //     :
                    //     '../components/Cards/Style3/index.php'
                    // );
                    ?>
                    @if($i === 0)
                        @web_component([ 'postfixes' => 'blogs.minimal.style1','data' => [] ])@endweb_component
                    @else
                        @web_component([ 'postfixes' => 'blogs.minimal.style2','data' => [] ])@endweb_component
                    @endif
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>