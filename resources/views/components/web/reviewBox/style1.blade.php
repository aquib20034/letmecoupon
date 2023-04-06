<div class="reviewBoxStyle1">
    <div class="reviewBox">
        <div class="reviewBox__wrapper">
            <div class="reviewBox__head">
                <h2 class="reviewBox__title">
                    Microsoft Xbox One S Review
                </h2>

                <div class="reviewBox__btn">
                    <a href="#" class="btn-2" aria-label="Follow">Follow</a>
                </div>
            </div>

            <div class="reviewBox__description">
                <p>
                    I am a highly organised and motivated professional Fashion Designer with a wealth of experience in a range of photographic styles and services. Just run your Fashion Store which will be a reflection of you a sexy and confident woman that shines with her unique style. Our goal is to make fashion as easy possible. We bring you the best of glam and sexy clothes while keeping in mind that high quality things arent always too expensive. Our goal is to make fashion as easy as possible, that is why we add carefully selected products on a daily basis,
                </p>
            </div>

            <ul class="reviewBox__list">
                <?php for ($x = 0; $x < 6; $x++) { ?>
                    <li class="reviewBox__listItem">
                        <div class="review">
                            <h3 class="review__title">Review Name</h3>
                            <div class="review__rating">
                                <span class="review__stars">
                                    <?php $rating = 4; ?>
                                    <?php for ($i = 0; $i < 5; $i++) { ?>
                                        <span class="icon <?php echo ($i < $rating ? 'rated' : 'unrated'); ?>">
                                            <i class="x_star-filled"></i>
                                        </span>
                                    <?php } ?>
                                </span>

                                <span class="review__text">
                                    <span>5.0</span> - <span>Extremely popular brand</span>
                                </span>
                            </div>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>