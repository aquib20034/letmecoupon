@extends('web.layouts.app')
@section('content')
    <div class="container">
        <div class="section">
            <!-- Breadcrumbs Section Starts Here -->
            <section class="section pd-none onlyDesktop">
                <div class="container-inner">
                <?php
                    $routes = [["title" => "Home", "path" => config('app.app_path')], ["title" => "All Reviews", "path" => config('app.app_path')."/reviews"]];
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
                            <div class="twoColumnLayout__shortColumn small onlyLargeDesktop">
                                <!-- Sidebar Starts Here -->
                                <div class="sidebar sticky js-stickySidebar">
                                    <!-- Sidebar Categories Section Starts Here -->
                                    <div class="sidebar__section">
                                        <h2 class="sidebar__heading">
                                            Categories
                                        </h2>

                                        <ul class="sidebar__navList">
                                            <?php for ($i = 0; $i < 3; $i++) { ?>
                                                <li class="sidebar__navItem">
                                                    <a href="{{config('app.app_path')}}/index.php" class="sidebar__navLink" aria-label="Category <?php echo ($i + 1); ?> Category Inner Page">
                                                        Category <?php echo ($i + 1); ?>
                                                    </a>
                                                </li>
                                            <?php } ?>

                                            <li class="sidebar__navItem">
                                                <a href="{{config('app.app_path')}}/index.php" class="sidebar__navLink primary" aria-label="View All Categories">
                                                    View All Categories
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- Sidebar Categories Section Ends Here -->

                                    <!-- Sidebar Meet the Authors Section Starts Here -->
                                    <div class="sidebar__section">
                                        <h2 class="sidebar__heading">
                                            Meet the Authors
                                        </h2>

                                        <ul class="sidebar__navList">
                                            <?php for ($i = 0; $i < 3; $i++) { ?>
                                                <li class="sidebar__navItem">
                                                    <a href="{{config('app.app_path')}}/author.php" class="sidebar__navLink" aria-label="Visit Author <?php echo ($i + 1); ?> Page">
                                                        Author <?php echo ($i + 1); ?>
                                                    </a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                    <!-- Sidebar Meet the Authors Section Ends Here -->
                                </div>
                                <!-- Sidebar Ends Here -->
                            </div>
                            <!-- Short Column Ends Here -->

                            <!-- Wide Column Starts Here -->
                            <div class="twoColumnLayout__wideColumn">
                                <!-- Popular Reviews Section Starts Here -->
                                <section class="section pd-top-none">
                                    <div>
                                        <h2 class="heading-1 primary">Popular Reviews</h2>
                                    </div>

                                    <div class="cardGrid-v2">
                                        <div class="cardGrid">
                                            <?php for ($i = 0; $i < 4; $i++) {
                                            ?>
                                                <div class="cardGrid__item">
                                                    <?php //include('../components/Cards/Style3/index.php'); ?>
                                                    @web_component([ 'postfixes' => 'reviews.minimal.style2','data' => [] ])@endweb_component
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </section>
                                <!-- Popular Reviews Section Ends Here -->

                                <!-- Recent Reviews Section Starts Here -->
                                <section class="section">
                                    <div>
                                        <h2 class="heading-1">Recent Reviews</h2>
                                    </div>

                                    <div class="cardGrid-v2">
                                        <div class="cardGrid">
                                            <?php for ($i = 0; $i < 12; $i++) {
                                            ?>
                                                <div class="cardGrid__item">
                                                    <?php //include('../components/Cards/Style3/index.php'); ?>
                                                    @web_component([ 'postfixes' => 'reviews.minimal.style2','data' => [] ])@endweb_component
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </section>
                                <!-- Recent Reviews Section Ends Here -->
                            </div>
                            <!-- Wide Column Ends Here -->
                        </div>
                    </div>
                </div>
            </section>
            <!-- Two Column Layout Section Ends Here -->

            <!-- Newsletter Section Starts Here -->
            <section class="section">
                <?php //include('../components/NewsLetterForm/Style1/index.php'); ?>
                @web_component([ 'postfixes' => 'newsletter.style1','data' => [] ])@endweb_component
            </section>
            <!-- Newsletter Section Starts Here -->

            <!-- Popular Reviews Section Starts Here -->
            <section class="section">
                <div class="container-inner">
                    <div>
                        <h2 class="heading-1">Popular Reviews</h2>
                    </div>

                    <div class="cardGrid-v1">
                        <div class="cardGrid">
                            <?php for ($i = 0; $i < 6; $i++) {
                            ?>
                                <div class="cardGrid__item">
                                    <?php //include('../components/Cards/Style3/index.php'); ?>
                                    @web_component([ 'postfixes' => 'reviews.minimal.style2','data' => [] ])@endweb_component
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Popular Reviews Section Ends Here -->
        </div>
    </div>
@endsection
