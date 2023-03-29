<h2 class="sidebar__heading">
    Categories
</h2>

<ul class="sidebar__navList">
    <?php for ($i = 0; $i < 3; $i++) { ?>
        <li class="sidebar__navItem">
            <a href="{{config('app.app_path')}}/category-inner" class="sidebar__navLink" aria-label="Visit <?php echo ($i + 1); ?> Category Inner Page">
                Category <?php echo ($i + 1); ?>
            </a>
        </li>
    <?php } ?>

    <li class="sidebar__navItem">
        <a href="{{config('app.app_path')}}/categories" class="sidebar__navLink primary" aria-label="View All Categories">
            View All Categories
        </a>
    </li>
</ul>