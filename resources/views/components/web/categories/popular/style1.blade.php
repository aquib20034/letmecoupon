<div class="popularListing-v1">
    <div class="popularListing">
        <div class="popularListing__wrapper">
            <div class="popularListing__header">
                <div>
                    <h2 class="heading-1 m-0">Popular Categories</h2>
                </div>

                <div>
                    <a href="#" class="btn-1 responsive" aria-label="View All">View All</a>
                </div>
            </div>

            <div class="popularListing__content">
                <ul class="popularListing__list" onmousedown="mouseDownHandler(this, event)" onmouseup="mouseUpHandler(this)" ontouchend="mouseUpHandler(this)" ontouchstart="mouseDownHandler(this, event)">
                    <?php for ($i = 1; $i <= 10; $i++) {
                    ?>
                        <li class="popularListing__listItem">
                            <?php //include('../components/Cards/Style4/index.php'); ?>
                            @web_component([ 'postfixes' => 'categories.minimal.style2','data' => [] ])@endweb_component
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>