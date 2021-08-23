<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //re_properties
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->string('listing_title', 256)->nullable();
            $table->string('address')->nullable();
            $table->string('city', 150)->nullable();
            $table->foreignId('state_id')->constrained('states');
            $table->foreignId('country_id')->constrained('countries');
            $table->string('zip', 20)->nullable();
            $table->string('county', 150)->nullable();
            $table->string('municipality', 150)->nullable();
            $table->text('description')->nullable();
            $table->text('directions')->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->unsignedTinyInteger('lat_long_manual')->default(0);
            $table->enum('status', ['bpo','watch_list','sheriff_sale','watch_list_confirmation','pre_listing','listed_active','pending_offer_still_showing','pending_offer_not_showing','pending_offer_record_only','accepted_offer','fell_thru','sold_closed','expired','hold'])->nullable()->default(null);
            $table->enum('seller_type', ['bank','rh_syndication','marketing_matters','time_limited_event','internal','rh_non_member_max','potential_upgrade','flat_fee_monthly','potential_upgrade_tle'])->nullable()->default(null);
            $table->enum('listing_type', ['traditional','auction','auction_managed','sheriff_sale'])->nullable()->default(null);
            $table->enum('property_type', ['commercial','residential','mixed_use','multi_family','land','international'])->nullable()->default(null);
            $table->enum('lockbox_type', ['electronic','combination','none'])->nullable()->default(null);
            $table->enum('closing_status', ['pending_showing','pending_not_showing','closed','fell_thru'])->nullable()->default(null);
            $table->unsignedTinyInteger('featured')->default(0);
            $table->unsignedDecimal('lot_size', 20, 4)->nullable();
            $table->enum('lot_size_unit', ['acre','square_feet','square_meter','hectare']);
            $table->unsignedDecimal('property_size', 20, 4)->nullable();
            $table->enum('property_size_unit', ['acre','square_feet','square_meter','hectare']);
            $table->text('property_types')->nullable();
            $table->text('showing_instructions')->nullable();
            $table->double('list_price', 10);
            $table->enum('list_price_unit', ['usd', 'cad', 'aud', 'jpy', 'gbp', 'chf', 'cny', 'sek', 'nzd', 'mxn', 'eur'])->default('usd');
            $table->string('list_price_disclaimer')->nullable();
            $table->double('sale_price', 10)->nullable();
            $table->unsignedTinyInteger('commission_percent')->nullable();
            $table->unsignedSmallInteger('days_on_market')->nullable();
            $table->string('parcel_number')->nullable();
            $table->date('listing_date')->nullable();
            $table->date('close_acceptance_date')->nullable();
            $table->date('close_date')->nullable();
            $table->date('close_posession_date')->nullable();
            $table->year('year_built')->nullable();
            $table->unsignedSmallInteger('baths')->nullable();
            $table->unsignedSmallInteger('beds')->nullable();
            $table->unsignedSmallInteger('half_baths')->nullable();
            $table->unsignedSmallInteger('units')->nullable();
            $table->string('lot_number', 64)->nullable();
            $table->string('slug', 512)->nullable();
            $table->string('location_md5')->nullable();
            $table->string('auctioneer_license')->nullable();
            $table->double('starting_bid', 10)->nullable();
            $table->string('starting_bid_disclaimer')->nullable();
            $table->double('reserve_price', 10)->nullable();
            $table->double('min_bid_increment', 10)->nullable();
            $table->text('terms_and_conditions')->nullable();
            $table->text('local_economy')->nullable();
            $table->text('due_diligence')->nullable();
            $table->string('realtor_license', 128)->nullable();
            $table->string('ad_description', 128)->nullable();
            $table->string('virtual_tour_link', 256)->nullable();
            $table->string('seo_keywords', 255)->nullable();
            $table->string('seo_title', 255)->nullable();
            $table->string('seo_description', 255)->nullable();
            $table->unsignedTinyInteger('cashifyd')->default(1); 
            //on to one

            $table->unsignedBigInteger('feed_id')->nullable();
            $table->string('listing_feed_id', 128)->nullable()->default(null);
            $table->string('feed_source', 128)->nullable();
            $table->string('feed_lead_routing_email', 128)->nullable();
            $table->text('feed_disclaimer')->nullable();
            $table->dateTime('feed_mod_timestamp')->nullable();
            $table->string('external_link', 512)->nullable();
            $table->string('mls_name', 256)->nullable();
            $table->string('provider_name', 128)->nullable();
            $table->string('provider_state', 24)->nullable();
            $table->string('listing_source', 256)->nullable();
            $table->string('listhub', 1)->nullable()->default('N');
            $table->string('listhub_listing_key', 128)->nullable();

            $table->unsignedBigInteger('project_id')->nullable();
            $table->unsignedBigInteger('bank')->nullable();
            $table->unsignedBigInteger('realtyhive_rep')->nullable();
            $table->unsignedBigInteger('realtyhive_liaison')->nullable();
            $table->unsignedBigInteger('real_estate_agent')->nullable();
            $table->unsignedBigInteger('broker_direct')->nullable();
            $table->unsignedBigInteger('private_seller')->nullable();
            $table->unsignedBigInteger('consumer_direct')->nullable();

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
        Schema::dropIfExists('listings');
    }
}
