<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMetaTemplateFieldsToSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sites', function (Blueprint $table) {
            $table->string('primary_keyword', 255);
            $table->string('secondary_keyword', 255);
            $table->text('store_meta_title_template');
            $table->text('store_meta_description_template');
            $table->text('category_meta_title_template');
            $table->text('category_meta_description_template');
            $table->text('category_page_title_template');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sites', function (Blueprint $table) {
            //
        });
    }
}
