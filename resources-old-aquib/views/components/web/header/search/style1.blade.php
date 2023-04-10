<div id="js-headerSearchStyle1" class="search">
    <div class="search__wrapper">
        <input type="text" placeholder="Search favorite stores e.g. Amazon, Aliexpress, Shein..." class="search__input">
        </input>

        <div class="search__button default">
            <span class="icon">
                <i class="x_Search">
                    <span class="path1"></span><span class="path2"></span>
                </i>
            </span>
        </div>

        <div class="search__button close">
            <span class="icon">
                <i class="x_close">
                </i>
            </span>
        </div>
    </div>

    <div id="js-headerSearchStyle1Dropdown" class="search__dropdown">
        <div class="dropdown">
            <div class="dropdown__wrapper">
                <ul class="dropdown__list">
                    <?php for ($i = 0; $i < 10; $i++) { ?>
                        <li class="dropdown__listItem">
                            <a href="{{ config('app.app_path') }}/stores-inner" class="title link" aria-label="Visit Store <?php echo ($i + 1); ?> Page">
                                Store <?php echo ($i + 1); ?>
                            </a>
                        </li>
                    <?php } ?>

                    <li class="dropdown__listItem">
                        <a href="{{ config('app.app_path') }}/stores" class="title link bold" aria-label="Browse All Stores">
                            Browse All Stores
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>