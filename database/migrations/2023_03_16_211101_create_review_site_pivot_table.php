<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewSitePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_site', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->unsignedInteger('review_id');
            $table->foreign('review_id', 'review_id_fk_700782')->references('id')->on('reviews')->onDelete('cascade');
            $table->unsignedInteger('site_id');
            $table->foreign('site_id', 'site_id_fk_700782')->references('id')->on('sites')->onDelete('cascade');
        });
    }
}
