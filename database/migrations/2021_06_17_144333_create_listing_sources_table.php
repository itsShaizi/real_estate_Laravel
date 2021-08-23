<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListingSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listing_sources', function (Blueprint $table) {

            $table->id();
            $table->foreignId('listing_id')->constrained('listings')->onDelete('cascade');
            $table->enum('source_type',['mls','third_party','other']);
            $table->string('mls_name',256)->nullable()->default('null');
            $table->string('source_val',200);
            $table->unsignedSmallInteger('mls_position')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('listing_sources');
    }
}
