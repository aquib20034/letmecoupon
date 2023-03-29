<div class="container-inner">
    <div>
        <h2 class="heading-1">Popular Blogs</h2>
    </div>

    <div class="cardGrid-v1">
        <div class="cardGrid">
            <?php for ($i = 0; $i < 3; $i++) {
            ?>
                <div class="cardGrid__item">
                    <?php //include('../components/Cards/Style3/index.php'); ?>
                    @web_component([ 'postfixes' => 'blogs.minimal.style2','data' => [] ])@endweb_component
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>