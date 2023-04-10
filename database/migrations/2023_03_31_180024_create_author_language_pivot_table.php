<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthorLanguagePivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('author_language', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->unsignedInteger('author_id');
            $table->foreign('author_id', 'author_id_fk_705782')->references('id')->on('authors')->onDelete('cascade');
            $table->unsignedInteger('language_id');
            $table->foreign('language_id', 'language_id_fk_705782')->references('id')->on('language_id')->onDelete('cascade');
        });
    }
}
