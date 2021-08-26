<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMissingColumnsToListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->json('additional_property_types')->nullable()->after('property_type');
            $table->double('opening_bid', 10)->nullable()->after('reserve_price');
            $table->date('listing_expiration_date')->nullable()->after('listing_date');
            $table->double('buyer_fee', 10)->nullable()->after('lot_number');
            $table->string('sale_number', 64)->nullable()->after('buyer_fee');
            $table->double('purchase_price', 10)->nullable()->after('sale_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('listings', function (Blueprint $table) {
            //
        });
    }
}
