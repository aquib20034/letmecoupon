<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewTagPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('review_tag', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->unsignedInteger('review_id');
            $table->foreign('review_id', 'review_id_fk_703782')->references('id')->on('reviews')->onDelete('cascade');
            $table->unsignedInteger('tag_id');
            $table->foreign('tag_id', 'tag_id_fk_703782')->references('id')->on('tags')->onDelete('cascade');
        });
    }
}
