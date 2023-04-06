<div class="ratingStyle1">
    <div class="rating">
        <div class="rating__text">
            <p>
                <span class="dark">
                    Have experience with the Microsoft Xbox One S?
                </span>
                &nbsp;
                <span class="light">
                    Share your own Microsoft Xbox One S review:
                </span>
            </p>
        </div>

        <div class="rating__stars">
            <?php $rating = 4; ?>
            <?php for ($i = 1; $i < 5; $i++) { ?>
                <span class="starBox <?php echo ($rating <= $i ? 'unrated' : 'rated'); ?>">
                    <i class="x_star-filled"></i>
                </span>
            <?php } ?>
        </div>
    </div>
</div>