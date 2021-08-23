<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feed_listings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('feed_id')->constrained('feeds');
            $table->string('mls_name');
            $table->string('mls_number');
            $table->string('mls_id');
            $table->string('provider_name');
            $table->string('listing_feed_id');
            $table->longText('raw_data');
            $table->string('md5', 32);
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
        Schema::dropIfExists('feed_listings');
    }
}
