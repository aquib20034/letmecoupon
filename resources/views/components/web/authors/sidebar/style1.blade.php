<h2 class="sidebar__heading">
    Meet the Authors
</h2>

<ul class="sidebar__navList">
    <?php for ($i = 0; $i < 3; $i++) { ?>
        <li class="sidebar__navItem">
            <a href="{{config('app.app_path')}}/author" class="sidebar__navLink" aria-label="Visit Author <?php echo ($i + 1); ?> Page">
                Author <?php echo ($i + 1); ?>
            </a>
        </li>
    <?php } ?>
</ul>