<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffiliateUrlLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('affiliate_url_logs', function (Blueprint $table) {
            $table->increments("id");
            $table->string('network_name')->nullable();
            $table->integer('store_id')->nullable();
            $table->integer('coupon_id')->nullable();
            $table->string('region')->nullable();
            $table->string('website')->nullable();
            $table->text('previous_aff_url')->nullable();
            $table->text('new_aff_url')->nullable();
            $table->integer('created_by')->nullable();
            $table->string('source')->nullable();
            $table->string('action',55)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('affiliate_url_logs');
    }
}
