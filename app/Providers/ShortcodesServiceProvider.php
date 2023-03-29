<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Shortcode;
use App\Shortcodes\BoldShortcode;
use App\Shortcodes\ItalicShortcode;

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
        //Shortcode::register('i', 'App\Shortcodes\ItalicShortcode@custom');
    }
}
