<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->longText('short_description');
            $table->longText('long_description');
            $table->boolean('publish')->default(0)->nullable();
            $table->string('meta_title');
            $table->string('meta_keywords');
            $table->string('meta_description', 250);
            $table->integer('sort');
            $table->boolean('featured')->default(0)->nullable();
            $table->boolean('popular')->default(0)->nullable();
            $table->integer('view')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('update_by')->nullable();
            $table->string('slug');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
