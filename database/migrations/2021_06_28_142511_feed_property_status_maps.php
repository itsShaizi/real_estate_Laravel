<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FeedPropertyStatusMaps extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('feed_property_status_maps', function (Blueprint $table) {

            $table->id();
            $table->string('input_status',256);
            $table->string('status',256);

        });
        DB::unprepared(file_get_contents(base_path().'/database/dumps/feed_property_status_maps.sql'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('feed_property_status_maps');
    }
}
