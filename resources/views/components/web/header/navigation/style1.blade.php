<nav class="navigation">
    <ul class="navigation__list">
        <li class="navigation__item">
            <div class="navigation__button">
                <span class="text">
                    Stores
                </span>
                <span class="icon">
                    <i class="x_arrow-down-1"></i>
                </span>
            </div>

            <div class="navigation__dropdown">
                <div class="dropdown">
                    <div class="dropdown__wrapper">
                        <ul class="dropdown__list">
                            <?php for ($i = 0; $i < 10; $i++) { ?>
                                <li class="dropdown__listItem">
                                    <a href="{{ config('app.app_path') }}/store-inner class="title link" aria-label="Visit Store <?php echo ($i + 1); ?> Page">
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
        </li>

        <li class="navigation__item">
            <div class="navigation__button">
                <span class="text">
                    Categories
                </span>
                <span class="icon">
                    <i class="x_arrow-down-1"></i>
                </span>
            </div>

            <div class="navigation__dropdown">
                <div class="dropdown">
                    <div class="dropdown__wrapper">
                        <ul class="dropdown__list">
                            <?php for ($i = 0; $i < 10; $i++) { ?>
                                <li class="dropdown__listItem">
                                    <a href="{{ config('app.app_path') }}/category-inner" class="title link" aria-label="Visit Category <?php echo ($i + 1); ?> Page">
                                        Category <?php echo ($i + 1); ?>
                                    </a>
                                </li>
                            <?php } ?>

                            <li class="dropdown__listItem">
                                <a href="{{ config('app.app_path') }}/category" class="title link bold" aria-label="Browse All Categories">
                                    Browse All Categories
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </li>

        <li class="navigation__item">
            <a href="{{ config('app.app_path') }}/blogs" class="navigation__button" aria-label="Visit Blogs Page">
                <span class="text">
                    Blogs
                </span>
                <!-- <span class="icon">
                    <i class="x_arrow-down-1"></i>
                </span> -->
            </a>
        </li>

        <li class="navigation__item">
            <a href="{{ config('app.app_path') }}/reviews" class="navigation__button" aria-label="Visit Our Reviews Page">
                <span class="text">
                    Reviews
                </span>
                <!-- <span class="icon">
                    <i class="x_arrow-down-1"></i>
                </span> -->
            </a>
        </li>
    </ul>
</nav>