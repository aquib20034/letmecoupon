<?php
$isDeal = 1;
$isExpired = 0;

// if ($i % 2 === 0) {
//     $isDeal = 0;
// }
?>
<div class="discountCardStyle2 js-discountCard <?php echo ($isDeal ? 'only-deals' : 'only-codes'); ?>">
    <div class="discountCard <?php echo ($isExpired ? 'discountCard--expired' : 'discountCard--active'); ?>">
        <div class="discountCard__wrapper">
            <div class="discountCard__image__wrapper">
                <div class="discountCard__image">
                    <figure>
                        <img src="../../build/images/store-image-1.webp" alt="Store Name">
                    </figure>
                </div>
            </div>

            <div class="discountCard__mid">
                <div class="discountCard__title">
                    <h2>New Season: 16% Off on Everything (Sitewide)</h2>
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
                <a href="<?php echo ($isExpired ? 'javascript:;' : '#'); ?>" class="<?php echo ($isDeal ? 'light' : 'dark'); ?>" aria-label="<?php echo ($isDeal ? 'Get Deal' : 'Get Code'); ?>">
                    <?php echo ($isDeal ? 'Get Deal' : 'Get Code'); ?>
                </a>
            </div>
        </div>
    </div>
</div>