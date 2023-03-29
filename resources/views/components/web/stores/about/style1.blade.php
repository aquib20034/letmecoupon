<div>
    <h2 class="heading-1">About Walmart</h2>
</div>

<div>
    <div class="storeAboutStyle1">
        <div class="storeAbout">
            <div class="storeAbout__wrapper">
                <div class="tab">
                    <div class="tab__nav onlyDesktop">
                        <?php for ($i = 0; $i < 4; $i++) { ?>
                            <div class="onlyDesktop">
                                <button type="button" class="tab__button js-tabButton <?php echo $i === 0 ? 'active' : '' ?>" aria-label="Toggle Tab" onclick="toggleAboutTabs(this, <?php echo $i ?>)">
                                    Tab No <?php echo ($i); ?>
                                </button>
                            </div>
                        <?php } ?>
                    </div>

                    <div class="tab__content">
                        <!-- This Loop Must Be Same As Above Loop -->
                        <?php for ($i = 0; $i < 4; $i++) { ?>
                            <div class="tab__content__box js-tabContentBox <?php echo ($i === 0 ? 'tab__content__box--show' : 'tab__content__box--hide'); ?>" data-about-tab="<?php echo ($i); ?>">
                                <!-- Tab Title For Mobile -->
                                <h2 class="tab__title onlyMobile">Tab No <?php echo ($i); ?> Heading</h2>

                                <p class="text"><?php echo ($i); ?>. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ex, numquam accusamus quo maxime omnis soluta? Facilis magni expedita, sit aspernatur pariatur modi delectus corporis quas saepe! Cum reprehenderit aliquid optio expedita rem suscipit consequatur animi accusantium, ducimus commodi dolor quaerat recusandae id ipsum, nesciunt eveniet at eum veniam laborum. Assumenda.</p>
                                <p class="text"><?php echo ($i); ?>. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ex, numquam accusamus quo maxime omnis soluta? Facilis magni expedita, sit aspernatur pariatur modi delectus corporis quas saepe! Cum reprehenderit aliquid optio expedita rem suscipit consequatur animi accusantium, ducimus commodi dolor quaerat recusandae id ipsum, nesciunt eveniet at eum veniam laborum. Assumenda.</p>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>