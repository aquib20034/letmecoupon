<h2 class="sidebar__heading">
    Stores
</h2>

<ul class="sidebar__navList">
    <?php for ($i = 0; $i < 3; $i++) { ?>
        <li class="sidebar__navItem">
            <a href="{{config('app.app_path')}}/store-inner" class="sidebar__navLink" aria-label="Visit <?php echo ($i + 1); ?> Store Inner Page">
                Store <?php echo ($i + 1); ?>
            </a>
        </li>
    <?php } ?>

    <li class="sidebar__navItem">
        <a href="{{config('app.app_path')}}/stores" class="sidebar__navLink primary" aria-label="View All Stores">
            View All Stores
        </a>
    </li>
</ul>