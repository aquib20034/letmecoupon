<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorSitePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('author_site', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->unsignedInteger('author_id');
            $table->foreign('author_id', 'author_id_fk_706782')->references('id')->on('authors')->onDelete('cascade');
            $table->unsignedInteger('site_id');
            $table->foreign('site_id', 'site_id_fk_706782')->references('id')->on('sites')->onDelete('cascade');
        });
    }
}
