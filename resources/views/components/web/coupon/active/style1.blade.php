<div>
    <h2 class="heading-1">Active Coupons & Deals</h2>
</div>

<div class="storeInnerGrid">
    <?php for ($i = 0; $i < 11; $i++) { ?>
        <?php
        $isDeal = 1;
        $isExpired = 0;

        if ($i % 2 === 0) {
            $isDeal = 0;
        }
        ?>
        <?php //include('../components/DiscountCard/Style1/index.php'); ?>
        <div class="discountCardStyle1 js-discountCard <?php echo ($isDeal ? 'only-deals' : 'only-codes'); ?>">
            <div class="discountCard <?php echo ($isExpired ? 'discountCard--expired' : 'discountCard--active'); ?>">
                <div class="discountCard__wrapper">
                    <div class="discountCard__image">
                        <figure>
                            <img src="../../build/images/store-image-1.webp" alt="Store Name">
                        </figure>
                    </div>

                    <div>
                        <div class="discountCard__title">
                            <h2>New Season: 16% Off on</h2>
                        </div>

                        <div class="discountCard__attributes">
                            <div>
                                <div class="tag">
                                    Sale
                                </div>
                            </div>

                            <span>
                                90 Used
                            </span>

                            <span class="success">
                                Verified
                            </span>
                        </div>
                    </div>

                    <div class="discountCard__cta">
                        <a href="<?php echo ($isExpired ? 'javascript:;' : '#'); ?>" class="<?php echo ($isDeal ? 'light' : 'dark'); ?>" aria-label="<?php echo ($isDeal ? 'Get Deal' : 'Show Coupon Code'); ?>">
                            <?php echo ($isDeal ? 'Get Deal' : 'Show Coupon Code'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>