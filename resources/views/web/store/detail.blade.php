@extends('web.layouts.app')
<style>
    .flashBanners {
        margin: 10px 10px 30px;
    }

    .flashBanners>div iframe {
        width: 100%;
    }
</style>
@section('content')
<div class="container">
        <div class="section">
            <!-- Breadcrumbs Section Starts Here -->
            <section class="section pd-none onlyDesktop">
                <div class="container-inner">
                    <?php
                    $routes = [["title" => "Home", "path" => config('app.app_path')], ["title" => "All Stores", "path" => config('app.app_path')."/sitemap"], ["title" => $detail['name'], "path" => config('app.app_path')."/".$detail['slugs']['slug'] ]];
                    //include('../components/Breadcrumbs/Style1/index.php');
                    ?>
                    @web_component([ 'postfixes' => 'breadcrumbs.style1','data' => ['routes' => $routes] ])@endweb_component
                </div>
            </section>
            <!-- Breadcrumbs Section Ends Here -->

            <!-- Store Info Card Section Starts Here -->
            <section class="section">
                <div class="container-inner">
                    <?php //include('../components/StoreInfoCard/Style1/index.php'); ?>
                    @web_component([ 'postfixes' => 'stores.info.style1','data' => ['store_detail' => $detail, 'site_wide_data' => $site_wide_data ] ])@endweb_component
                </div>
            </section>
            <!-- Store Info Card Section Ends Here -->

            <!-- Two Column Layout Section Starts Here -->
            <section class="section">
                <div class="container-inner">
                    <div class="twoColumnLayout-v1">
                        <div class="twoColumnLayout">
                            <!-- Short Column Starts Here -->
                            <div class="twoColumnLayout__shortColumn">
                                <!-- Sidebar Starts Here -->
                                <div class="sidebar sticky js-stickySidebar">
                                    <!-- Sidebar Filters Section Starts Here -->
                                    <div class="sidebar__section">
                                        <h2 class="sidebar__heading onlyLargeDesktop">
                                            Filters
                                        </h2>

                                        <div class="sidebar__filters">
                                            <div class="filters-v1">
                                                <div class="filters filters--mobile">
                                                    <div class="filters__wrapper">
                                                        <div class="checkboxFilter checkboxFilter--mobile">
                                                            <span class="checkboxFilter__wrapper">
                                                                <input class="checkboxFilter__input" id="all-filter-default" data-visibility="all" type="radio" name="defaultStoreFilter" checked onchange="filterDiscountCards(this)" />
                                                                <label for="all-filter-default" class="checkboxFilter__label">{{ trans('sentence.all') }}</label>
                                                            </span>
                                                        </div>

                                                        

                                                        <div class="checkboxFilter checkboxFilter--mobile">
                                                            <span class="checkboxFilter__wrapper">
                                                                <input class="checkboxFilter__input" id="only-deals-filter-default" data-visibility="only-deals" type="radio" name="defaultStoreFilter" onchange="filterDiscountCards(this)" />
                                                                <label for="only-deals-filter-default" class="checkboxFilter__label">{{ trans('sentence.only_deals') }}</label>
                                                            </span>
                                                        </div>

                                                        <div class="checkboxFilter checkboxFilter--mobile">
                                                            <span class="checkboxFilter__wrapper">
                                                                <input class="checkboxFilter__input" id="only-codes-filter-default" data-visibility="only-codes" type="radio" name="defaultStoreFilter" onchange="filterDiscountCards(this)" />
                                                                <label for="only-codes-filter-default" class="checkboxFilter__label">{{ trans('sentence.only_codes') }}</label>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Sidebar Filters Section Ends Here -->
                                     @if (!empty($popularStores))
                                    <!-- Sidebar Popular Stores Section Starts Here -->
                                    <div class="sidebar__section onlyLargeDesktop">
                                        @web_component([ 'postfixes' => 'stores.popular.style2','data' => ['title' => 'Popular Stores', 'stores' => $popularStores] ])@endweb_component
                                    </div>
                                    <!-- Sidebar Popular Stores Section Ends Here -->
                                    @endif


                                    @if (!empty($featuredStores))
                                    <!-- Sidebar Related Stores Section Starts Here -->
                                    <div class="sidebar__section onlyLargeDesktop">
                                        @web_component([ 'postfixes' => 'stores.popular.style2','data' => ['title' => 'Related Stores', 'stores' => $featuredStores] ])@endweb_component
                                    </div>
                                    <!-- Sidebar Related Stores Section Ends Here -->
                                    @endif
                                </div>
                                <!-- Sidebar Ends Here -->
                            </div>
                            <!-- Short Column Ends Here -->

                            <!-- Wide Column Starts Here -->
                            <div class="twoColumnLayout__wideColumn">
                                <!-- Category Cards Grid Section Starts Here -->
                                <section class="section pd-top-none">
                                    <div class="storeInnerGrid storeInnerGrid--category">
                                        @if (!empty($popularCategories))
                                            <?php //include('../components/Cards/Style5/index.php'); ?>
                                            @web_component([ 'postfixes' => 'categories.minimal.style3','data' => [ 'categories' => $popularCategories] ])@endweb_component
                                        @endif
                                    </div>
                                </section>
                                <!-- Category Cards Grid Section Ends Here -->

                                <!-- Active Coupons & Deals Grid Section Starts Here -->
                                <section class="section">
                                    @web_component([ 'postfixes' => 'coupon.active.style1','data' => [ 'detail' => $detail ] ])@endweb_component
                                </section>
                                <!-- Active Coupons & Deals Grid Section Ends Here -->

                                <!-- Expired Coupons & Deals Grid Section Starts Here -->
                                <section class="section">
                                    @web_component([ 'postfixes' => 'coupon.expired.style1','data' => [ 'detail' => $detail ] ])@endweb_component
                                </section>
                                <!-- Expired Coupons & Deals Grid Section Ends Here -->

                                <!-- Tabular Details Section Starts Here -->
                                <section class="section">
                                    <?php //include('../components/TabularDetails/Style1/index.php'); ?>
                                    @web_component([ 'postfixes' => 'promocodes.popular.style1','data' => [ 'detail' => $detail ] ])@endweb_component
                                </section>
                                <!-- Tabular Details Section Ends Here -->

                                <!-- About Store Section Starts Here -->
                                <section class="section">
                                    <?php //include('../components/TabularDetails/Style1/index.php'); ?>
                                    @web_component([ 'postfixes' => 'stores.about.style1','data' => [] ])@endweb_component
                                </section>
                                <!-- About Store Section Ends Here -->

                                <!-- FAQs Section Starts Here -->
                                <section class="section">
                                    @web_component([ 'postfixes' => 'faqs.style1','data' => [ 'detail' => $detail ]  ])@endweb_component
                                </section>
                                <!-- FAQs Section Ends Here -->

                                
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
                @web_component([ 'postfixes' => 'reviews.popular.style2','data' => ['popular_reviews' => $popular_reviews] ])@endweb_component
            </section>
            <!-- Popular Reviews Section Ends Here -->

            <!-- Recent Blogs Section Starts Here -->
            <section class="section">
                @web_component([ 'postfixes' => 'blogs.popular.style2','data' => ['popular_blogs' => $popular_blogs] ])@endweb_component
            </section>
            <!-- Recent Blogs Section Ends Here -->
        </div>
    </div>
@endsection


@push('scripts')

<script>
function filterDiscountCards(e){
    try {
        const o = e.attributes["data-visibility"].value;
        var t = document.querySelectorAll(".js-discountCard");
        return t.length ? ("all" === o ? t.forEach(e=>{
            e.style.display = "block"
        }
        ) : t.forEach(e=>{
            e.classList.contains(o) ? e.style.display = "block" : e.style.display = "none"
        }
        ),
        !0) : !1
    } catch (e) {
        return console.log(e),
        !1
    }
}

function toggleAccordion(t){
    try {
        var e = document.querySelectorAll(".js-accordionStyle1");
        return e.length ? (e.forEach(e=>{
            e = e.querySelector(".accordion__head");
            t !== e || e.classList.contains("active") ? e.classList.remove("active") : e.classList.add("active")
        }
        ),
        !0) : !1
    } catch (e) {
        return console.log(e),
        !1
    }
}

</script>

@endpush
