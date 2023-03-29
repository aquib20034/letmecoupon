<div class="storeInfoCard-v1">
    <div class="storeInfoCard">
        <div class="twoColumnLayout-v1">
            <div class="twoColumnLayout">
                <!-- Short Column Starts Here -->
                <div class="twoColumnLayout__shortColumn">
                    <div class="storeInfoCard__image">
                        <div class="storeInfoCard__image__wrapper">
                            <figure>
                                <img src="../../build/images/store-image-1.webp" alt="Store Name">
                            </figure>
                        </div>
                    </div>
                </div>
                <!-- Short Column Ends Here -->

                <!-- Wide Column Starts Here -->
                <div class="twoColumnLayout__wideColumn">
                    <div class="storeInfoCard__title">
                        <h1 class="heading-2 primary m-0">Walmart</h1>
                    </div>

                    <div class="storeInfoCard__rating">
                        <span class="storeInfoCard__rating__attribute storeInfoCard__rating__attribute--count">
                            4.2
                        </span>

                        <div class="storeInfoCard__rating__stars">
                            <?php $rating = 4; ?>
                            <?php for ($i = 0; $i < 5; $i++) { ?>
                                <span class="icon <?php echo ($i < $rating ? 'filled' : 'unfilled'); ?>">
                                    <i class="<?php echo ($i < $rating ? 'x_star-filled' : 'x_star-unfilled'); ?>"></i>
                                </span>
                            <?php } ?>
                        </div>

                        <span class="storeInfoCard__rating__attribute storeInfoCard__rating__attribute--reviews">
                            (7.9)
                        </span>
                    </div>

                    <div class="storeInfoCard__subTitle">
                        <h2>
                            Walmart Products, Blogs and Reviews
                        </h2>
                    </div>

                    <div class="storeInfoCard__description">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa totam repudiandae aut quibusdam impedit quod a, officiis dolores, earum illum quia aliquam. Magni dignissimos maiores omnis eveniet sequi iure ad nemo odit, cum delectus, perferendis nam sed laboriosam sunt rem. Officiis, culpa nesciunt? Error similique deserunt numquam itaque a voluptas id aut, sint labore? Excepturi sed quo dolores, dolorum veritatis consequuntur tenetur ipsum voluptatem impedit natus at debitis, consequatur eos accusamus vero nulla sit inventore quam illum necessitatibus, soluta accusantium?</p>
                    </div>
                </div>
                <!-- Wide Column Ends Here -->
            </div>
        </div>
    </div>
</div>