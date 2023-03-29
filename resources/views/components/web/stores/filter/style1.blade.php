<div class="storeFilterStyle1">
    <div class="storeFilter">
        <ul class="storeFilter__list">
            <?php foreach ($alphabet_store as $key => $item) : ?>
                <li class="storeFilter__item">
                    <a href="#<?php echo $key ?>" class="storeFilter__link" aria-label="Visit <?php echo ($key); ?> Store Inner Page">
                        {{strtoupper($key)}}
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>