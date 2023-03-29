<div>
    <h2 class="heading-1">Recent Reviews</h2>
</div>

<div class="cardGrid-v2">
    <div class="cardGrid">
        <?php for ($i = 0; $i < 12; $i++) {
        ?>
            <div class="cardGrid__item">
                <?php //include('../components/Cards/Style3/index.php'); ?>
                @web_component([ 'postfixes' => 'reviews.minimal.style2','data' => [] ])@endweb_component
            </div>
        <?php
        }
        ?>
    </div>
</div>