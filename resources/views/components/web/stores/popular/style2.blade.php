<h2 class="sidebar__heading">
    {{$title}}
</h2>

<div class="popularListing-v1">
    <div class="popularListing popularListing--grid-3">
        <div class="popularListing__wrapper">
            <div class="popularListing__content">
                <ul class="popularListing__list">
                    <?php for ($i = 1; $i <= 9; $i++) {
                    ?>
                        <?php $variant = '3'; ?>
                        <li class=" popularListing__listItem">
                            @web_component([ 'postfixes' => 'stores.minimal.style1','data' => ['variant' => $variant] ])@endweb_component
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>