<div class="cardStyle4">
    <?php $variant = isset($variant)?$variant:'2'; ?>
    <?php $pageName = ['Category Inner', 'Store Inner', 'Store Inner', 'Product']; ?>
    <?php $images = ['category', 'store', 'store', 'product']; ?>
    <?php $urls = ['category-inner.php', 'store-inner.php', 'store-inner.php', 'index.php']; ?>

    <a href="{{ config('app.app_path') }}/{{ isset($store['slugs']) ? $store['slugs']['slug'] : '#' }}" class="card <?php echo "card--{$variant}"; ?>" aria-label="Visit <?php echo "{$pageName[$variant - 1]}"; ?> Page" draggable="false">
        <div class="card__wrapper">
            <div class="card__top">
                <div class="card__image">
                    <figure>
                    <img src="{{ isset($store['store_image']) ? $store['store_image'] : config('app.app_image') . '/build/images/placeholder.png' }}" alt="" draggable="false">
                    </figure>
                </div>
            </div>

            <div class="card__bottom">
                <h3 class="card__title">
                    {{isset($store['name']) ? $store['name'] : ""}}
                </h3>
            </div>
        </div>
    </a>
</div>