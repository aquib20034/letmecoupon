<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOptionsToCouponCardStylePrimaryEnumInWebsiteSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("ALTER TABLE `website_settings` CHANGE `coupon_card_style_primary` `coupon_card_style_primary` ENUM('style-1','style-2','style-3','style-4','style-5') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'style-1';");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('website_settings', function (Blueprint $table) {
            //
        });
    }
}
