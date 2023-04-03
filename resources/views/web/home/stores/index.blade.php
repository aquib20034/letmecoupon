@extends('web.layouts.app')
@section('content')
    <div class="container">[b class="heading-1 primary"]Bold text[/b]
        <div class="section">
            <!-- Breadcrumbs Section Starts Here -->
            <section class="section pd-none onlyDesktop">
                <div class="container-inner">
                    <?php
                    $routes = [["title" => "Home", "path" => config('app.app_path')], ["title" => "All Stores", "path" => config('app.app_path')."/stores"]];
                    //include('../components/Breadcrumbs/Style1/index.php');
                    ?>
                    @web_component([ 'postfixes' => 'breadcrumbs.style1','data' => ['routes' => $routes] ])@endweb_component
                </div>
            </section>
            <!-- Breadcrumbs Section Ends Here -->

            <!-- Two Column Layout Section Starts Here -->
            <section class="section">
                <div class="container-inner">
                    <div class="twoColumnLayout-v1">
                        <div class="twoColumnLayout">
                            <!-- Short Column Starts Here -->
                            <div class="twoColumnLayout__shortColumn onlyDesktop">
                                <!-- Sidebar Starts Here -->
                                <div class="sidebar sticky js-stickySidebar">
                                    <!-- Sidebar Popular Stores Section Starts Here -->
                                    <div class="sidebar__section">
                                        <h2 class="sidebar__heading">
                                            Popular Stores
                                        </h2>

                                        <div class="popularListing-v1">
                                            <div class="popularListing popularListing--grid-3">
                                                <div class="popularListing__wrapper">
                                                    <div class="popularListing__content">
                                                        <ul class="popularListing__list">
                                                            @if (!empty($popular))
                                                                @foreach ($popular as $store)
                                                                    <?php $variant = '3'; ?>
                                                                    <li class=" popularListing__listItem">
                                                                        <?php //include('../components/Cards/Style4/index.php'); ?>
                                                                        @web_component([ 'postfixes' => 'stores.minimal.style2','data' => ['variant' => $variant, 'store'=>$store] ])@endweb_component
                                                                    </li>
                                                                @endforeach
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Sidebar Popular Stores Section Ends Here -->

                                    <!-- Sidebar Store Index Section Starts Here -->

                                    @php
                                        $newArray = [];
                                        if (isset($list) && count($list) > 0) {
                                            foreach ($list as $item) {
                                                $letter = trim(strtolower($item['name'][0]));
                                        
                                                if (ctype_alpha($letter)) {
                                                    if (isset($newArray[$letter])) {
                                                        $newArray[$letter][] = $item;
                                                    } else {
                                                        $newArray[$letter] = [$item];
                                                    }
                                                } elseif (is_numeric(substr($letter, 0, 1))) {
                                                    if (isset($newArray['0-9']) && count($newArray['0-9'])) {
                                                        $newArray['0-9'][] = $item;
                                                    } else {
                                                        $newArray['0-9'] = [$item];
                                                    }
                                                } else {
                                                    $newArray['0-9'][] = $item;
                                                }
                                            }
                                        }
                                    @endphp

                                    
                                    <div class="sidebar__section">
                                        <h2 class="sidebar__heading">
                                            Index
                                        </h2>

                                        <div class="sidebar__storeFilter">
                                            <?php //include('../components/StoreFilter/Style1/index.php'); ?>
                                            @web_component([ 'postfixes' => 'stores.filter.style1','data' => ['alphabet_store' => $newArray] ])@endweb_component
                                        </div>
                                    </div>
                                    <!-- Sidebar Store Index Section Starts Here -->
                                </div>
                                <!-- Sidebar Ends Here -->
                            </div>
                            <!-- Short Column Ends Here -->

                            <!-- Wide Column Starts Here -->
                            <div class="twoColumnLayout__wideColumn">
                                <div class="storeListing-v1">
                                    <div class="storeListing">
                                        <div class="storeListing__heading">
                                            <h1 class="heading-1 primary">All Stores</h1>
                                        </div>

                                        <div class="storeListing__dropdown onlyMobile">
                                            <?php  //include('../components/Inputs/Select/Style1/index.php'); ?>
                                        </div>
                                        <ul class="storeListing__list">
                                            <li>
                                                @web_component([ 'postfixes' => 'stores.indexes.style1','data' => ['alphabet' => $newArray] ])@endweb_component
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- Wide Column Ends Here -->
                        </div>
                    </div>
                </div>
            </section>
            <!-- Two Column Layout Section Ends Here -->

            <!-- Popular Stores Grid Section Starts Here -->
            <div class="section onlyMobile">
                <div class="container-inner">
                    <div>
                        <h2 class="heading-1">Popular Stores</h2>
                    </div>

                    <div class="popularListing-v1">
                        <div class="popularListing popularListing--grid-3">
                            <div class="popularListing__wrapper">
                                <div class="popularListing__content">
                                    <ul class="popularListing__list">
                                        <?php for ($i = 1; $i <= 9; $i++) {
                                        ?>
                                            <?php $variant = '3'; ?>
                                            <li class="popularListing__listItem">
                                                <?php //include('../components/Cards/Style4/index.php'); ?>
                                                @web_component([ 'postfixes' => 'stores.minimal.style1','data' => ['variant' => $variant] ])@endweb_component
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>

                                    <!-- <div class="popularListing__gridCta onlyMobile">
                                        <a href="#" class="btn-1" aria-label="View All">View All</a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Popular Stores Grid Section Ends Here -->

            <!-- Newsletter Section Starts Here -->
            <section class="section">
                <?php //include('../components/NewsLetterForm/Style1/index.php'); ?>
                @web_component([ 'postfixes' => 'newsletter.style1','data' => [] ])@endweb_component
            </section>
            <!-- Newsletter Section Starts Here -->

            <!-- Recent Blogs Section Starts Here -->
            <section class="section">
                @web_component([ 'postfixes' => 'blogs.recent.style1','data' => [] ])@endweb_component
            </section>
            <!-- Recent Blogs Section Ends Here -->
        </div>
    </div>
@endsection
