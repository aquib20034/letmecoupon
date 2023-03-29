<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewStorePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_store', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->unsignedInteger('review_id');
            $table->foreign('review_id', 'review_id_fk_704782')->references('id')->on('reviews')->onDelete('cascade');
            $table->unsignedInteger('store_id');
            $table->foreign('store_id', 'store_id_fk_704782')->references('id')->on('stores')->onDelete('cascade');
        });
    }
}
