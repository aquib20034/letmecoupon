<div class="comparisonTableStyle1">
    <div class="comparisonTable">
        <table class="table">
            <thead class="table__head">
                <tr class="table__row">
                    <!-- 1.1 Empty top left box -->
                    <td class="table__data"></td>

                    <!-- 1.2 Cards -->
                    <?php for ($i = 0; $i < 5; $i++) { ?>
                        <th class="table__heading" scope="col">
                            <div class="productCard">
                                <div class="productCard__wrapper">
                                    <div class="productCard__image">
                                        <figure>
                                            <img src="../../build/images/product-image-1.webp" alt="Product Name">
                                        </figure>
                                    </div>

                                    <h2 class="productCard__title">Product <?php echo ($i); ?></h2>

                                    <div class="productCard__subTitle">
                                        Evolution Indoor Game Basketball
                                    </div>

                                    <div class="productCard__cta">
                                        <a href="#" aria-label="Check Price">Check Price</a>
                                    </div>

                                    <div class="productCard__brand">
                                        <figure>
                                            <img src="../../build/images/store-image-1.webp" alt="Store Name">
                                        </figure>
                                    </div>
                                </div>
                            </div>
                        </th>
                    <?php } ?>
                </tr>
            </thead>

            <tbody class="table__body">
                <?php for ($i = 0; $i < 5; $i++) { ?>
                    <tr class="table__row">
                        <!-- 2.1 Row Heading -->
                        <th class="table__heading" scope="row">Heading</th>
                        <!-- 2.1 Row Columns -->
                        <td class="table__data">Column 1</td>
                        <td class="table__data">Column 2</td>
                        <td class="table__data">
                            <?php echo ($i % 2 === 0 ? '<i class="icon x_check"></i>' : '<i class="icon x_close"></i>'); ?>
                        </td>
                        <td class="table__data">Column 4</td>
                        <td class="table__data">Column 5</td>
                    </tr>
                <?php } ?>

                <!-- Last Row (Includes CTA) -->
                <tr class="table__row">
                    <!-- 2.1 Row Heading -->
                    <th class="table__heading" scope="row">Heading</th>
                    <!-- 2.1 Row Columns -->
                    <?php for ($i = 0; $i < 5; $i++) { ?>
                        <td class="table__data">
                            <div class="table__cta">
                                <p class="t1">
                                    25% Off
                                </p>
                                <p class="t2">
                                    Code: VETERANS25
                                </p>

                                <a href="#" class="btn" aria-label="Get from Amazon">
                                    Get from Amazon
                                </a>
                            </div>
                        </td>
                    <?php } ?>
                </tr>
            </tbody>
        </table>
    </div>
</div>