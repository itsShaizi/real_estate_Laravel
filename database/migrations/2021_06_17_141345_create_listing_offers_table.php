<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //intended to replace 2 tables: Listing_Auction_Bods and Listing_Offers
        Schema::create('listing_offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('listing_id')->constrained('listings')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->unsignedBigInteger('auction_id')->nullable()->default(null);
            $table->unsignedBigInteger('offer_amount');
            $table->enum('offer_type', ['traditional', 'auction']);
            $table->enum('outcome', ['accepted', 'counter_offer', 'denied', 'dead'])->nullable();
            $table->text('details')->nullable();
            $table->timestamps();
            $table->softDeletes('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listing_offers');
    }
}
