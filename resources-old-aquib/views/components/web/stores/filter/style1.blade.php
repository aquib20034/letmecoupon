<div class="storeFilterStyle1">
    <div class="storeFilter">
        <ul class="storeFilter__list">
            <?php $sort_by_alphabet = ['0-9', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'] ?>
            <?php foreach ($sort_by_alphabet as $alphabet) : ?>
                <li class="storeFilter__item">
                    <a href="#<?php echo $alphabet ?>" class="storeFilter__link" aria-label="Visit <?php echo ($alphabet_store); ?> Store Inner Page">
                        <?php echo $alphabet ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>