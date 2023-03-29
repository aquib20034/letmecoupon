<!-- Swiper -->
<div class="homeCategorySwiper__container">
    <div class="swiper homeCategorySwiper">
        <div class="swiper-wrapper">
            <?php for ($i = 0; $i < 12; $i++) {
            ?>
                <div class="swiper-slide">
                    <?php //include('../components/Cards/Style1/index.php'); ?>
                    @web_component([ 'postfixes' => 'categories.minimal.style1','data' => [] ])@endweb_component
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>