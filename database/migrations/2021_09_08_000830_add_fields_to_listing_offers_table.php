<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToListingOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('listing_offers', function (Blueprint $table) {
            $table->string('currency', 10)->nullable()->after('offer_amount');
            $table->bigInteger('currency_amount')->nullable()->after('currency');
            $table->double('exchange_rate', 20)->nullable()->after('currency_amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('listing_offers', function (Blueprint $table) {
            $table->dropColumn(['currency', 'currency_amount', 'exchange_rate']);
        });
    }
}
