<div class="breadCrumbStyle1">
    <ul class="breadCrumbListing">
        <?php foreach ($routes as $route) {
        ?>
            <li>
                <a href="<?php echo "{{ config('app.app_path') }}/{$route["path"]}"; ?>" class="breadCrumb" aria-label="Visit <?php echo ($route['title']); ?>">
                    <?php echo ($route['title']); ?>
                </a>
            </li>
        <?php
        }
        ?>
    </ul>

</div>