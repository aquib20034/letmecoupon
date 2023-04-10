<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\WebModel\Store;
use App\WebModel\Category;
use View;
use Illuminate\Support\Facades\Schema;

class SiteProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $siteid             = config('app.siteid');
        $popular_stores     = Store::CustomWhereBasedData($siteid)->where('popular',1)->orderBy('id', 'desc')->take(5)->get()->toArray();;
        $popular_categories = Category::CustomWhereBasedData($siteid)->where('popular', 1)->orderBy('id', 'desc')->take(5)->get()->toArray();
        $all_sites          = getAllSitesForNav();
        $current_country    = searchForKey($siteid,$all_sites);
        
        if (Schema::hasTable('stores')) {
            View::share('current_country',          $current_country);
            View::share('nav_all_sites',            $all_sites);
            View::share('nav_popular_categories',   $popular_categories);
            View::share('nav_popular_stores',       $popular_stores);
        }
    }
}
