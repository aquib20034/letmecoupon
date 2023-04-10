<div class="dropdown">
    <div class="dropdown__wrapper">
        <div class="dropdown__top">
            <div class="dropdown__figure">
                <figure>
                    <img src="../../build/images/flag.webp" alt="Flag">
                </figure>
            </div>

            <span class="dropdown__icon">
                <i class="x_arrow-down-1"></i>
            </span>
        </div>

        <div class="dropdown__bottom">
            <div class="countrySelect">
                <div class="countrySelect__top">
                    <div class="typography">
                        <div class="subTitle">
                            Current Region
                        </div>

                        <div class="title">
                            Pakistan
                        </div>
                    </div>

                    <div class="image">
                        <figure>
                            <img src="../../build/images/flag.webp" alt="Flag">
                        </figure>
                    </div>
                </div>

                <div class="countrySelect__bottom">
                    <div class="subTitle">
                        Current Region
                    </div>

                    <ul class="countrySelect__list">
                        <?php for ($i = 0; $i < 10; $i++) { ?>
                            <li class="dropdown__listItem">
                                <a href="{{ config('app.app_path') }}" class="title link" aria-label="Visit Country <?php echo ($i + 1); ?> Region">
                                    Country <?php echo ($i + 1); ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>