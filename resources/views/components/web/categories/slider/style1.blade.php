<!-- Swiper -->
@if(isset($featuredCategories) && (!empty($featuredCategories)))
<div class="homeCategorySwiper__container">
    <div class="swiper homeCategorySwiper">
        <div class="swiper-wrapper">
            @foreach($featuredCategories as $key=>$featuredCategory)
                <div class="swiper-slide">
                    <?php //include('../components/Cards/Style1/index.php'); ?>
                    @web_component([ 'postfixes' => 'categories.minimal.style1','data' => ['category' => $featuredCategory] ])@endweb_component
                </div>
            @endforeach
        </div>
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>
@endif