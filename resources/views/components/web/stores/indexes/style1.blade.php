<div class="storeBoxStyle1">
    <?php $alphabet_stores = ['1001 Jewelry', '1001 Pharmacies', '1001 tires', '24S', '24S', '1001Hobbies (1001 model', '123 Consumables', '4 feet', '123 flowers', '3 Swiss', '123 spare parts', '50factory', '123 PVC ALU', '123Tires Belgium', '4walls', '123elec', '3 Swiss Belgium', '3AS Racing', '123caps', '3 Swiss', '24S']; ?>

    <div id="<?php echo ($alphabet); ?>" class="storeBox">
        <div class="storeBox__wrapper">
            <h2 class="storeBox__heading">
                <?php echo ($alphabet); ?>
            </h2>

            <ul class="storeBox__list">
                <?php foreach ($alphabet_stores as $alphabet_store) { ?>
                    <li class="storeBox__item">
                        <a href="/store-inner.php" class="storeBox__link" aria-label="Visit <?php echo ($alphabet_store); ?> Store Inner Page">
                            <?php echo ($alphabet_store); ?>
                        </a>
                    </li>
                <?php }; ?>
            </ul>
        </div>
    </div>
</div>