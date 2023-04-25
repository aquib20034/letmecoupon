<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Shortcode;
use App\Shortcodes\BoldShortcode;
use App\Shortcodes\ItalicShortcode;
use App\Shortcodes\CouponShortcode;
use App\Shortcodes\NewsletterShortcode;

class ShortcodesServiceProvider extends ServiceProvider
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
        //
        Shortcode::register('b', BoldShortcode::class);
        Shortcode::register('i', ItalicShortcode::class);
        Shortcode::register('coupon', CouponShortcode::class);
        Shortcode::register('newsletter', NewsletterShortcode::class);
        //Shortcode::register('i', 'App\Shortcodes\ItalicShortcode@custom');
    }
}
