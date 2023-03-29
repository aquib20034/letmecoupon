<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewCategoryPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_category', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->unsignedInteger('review_id');
            $table->foreign('review_id', 'review_id_fk_702782')->references('id')->on('reviews')->onDelete('cascade');
            $table->unsignedInteger('category_id');
            $table->foreign('category_id', 'category_id_fk_702782')->references('id')->on('categories')->onDelete('cascade');
        });
    }
}
