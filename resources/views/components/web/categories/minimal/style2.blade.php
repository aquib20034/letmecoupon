<div class="cardStyle4">
    <?php $variant = '1'; ?>
    <?php $pageName = ['Category Inner', 'Store Inner', 'Store Inner', 'Product']; ?>
    <?php $images = ['category', 'store', 'store', 'product']; ?>
    <?php $urls = ['category-inner.php', 'store-inner.php', 'store-inner.php', 'index.php']; ?>

    <a href="{{ config('app.image_path')}}/{{$urls[$variant - 1]}}"" class="card <?php echo "card--{$variant}"; ?>" aria-label="Visit <?php echo "{$pageName[$variant - 1]}"; ?> Page" draggable="false">
        <div class="card__wrapper">
            <div class="card__top">
                <div class="card__image">
                    <figure>
                        <img src="../../build/images/<?php echo ($images[$variant - 1]); ?>-image-1.webp" alt="" draggable="false">
                    </figure>
                </div>
            </div>

            <div class="card__bottom">
                <h3 class="card__title">
                    Laptop
                </h3>
            </div>
        </div>
    </a>
</div>