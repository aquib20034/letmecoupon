


<div class="cardStyle4">
<?php $variant = '1';     ?>
    <?php $pageName = ['Product Inner', 'Store Inner', 'Store Inner', 'Product']; ?>
    <?php $images = ['product', 'store', 'store', 'product']; ?>
    <?php $urls = ['product-inner.php', 'store-inner.php', 'store-inner.php', 'index.php']; ?>

    <!-- <a href="{{ config('app.image_path')}}/{{$urls[$variant - 1]}}"" class="card <?php echo "card--{$variant}"; ?>" aria-label="Visit <?php echo "{$pageName[$variant - 1]}"; ?> Page" draggable="false"> -->
    <a href="{{ config('app.app_path') }}/authors/{{ isset($author->id) ? $author->id : '#' }}" class="card <?php echo "card--{$variant}"; ?>" aria-label="Visit <?php echo "{$pageName[$variant - 1]}"; ?> Page" draggable="false">
    
        <div class="card__wrapper">
            <div class="card__top">
                <div class="card__image">
                    <figure>
                        <!-- <img src="../../build/images/<?php echo ($images[$variant - 1]); ?>-image-1.webp" alt="" draggable="false"> -->
                        <img src="{{ isset($author->image) ? $author->image : config('app.image_path') . '/build/images/user-image-1.webp'  }}" alt="" draggable="false">
                    </figure>
                </div>
            </div>

            <div class="card__bottom">
                <h3 class="card__title">
                    {!! (isset($author->first_name)) ? ($author->first_name) : "" !!}
                    {!! (isset($author->last_name)) ? ($author->last_name) : "" !!}
                </h3>
            </div>
        </div>
    </a>
</div>