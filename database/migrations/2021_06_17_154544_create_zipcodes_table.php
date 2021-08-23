<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZipcodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zipcodes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('county');
            $table->unsignedBigInteger('state')->nullable();
            $table->string('alt_state',128)->nullable()->default('null');
            $table->string('city')->nullable()->default('null');
            $table->string('zip');
            $table->enum('zip_type', ['military','po_box_only','standard','unique','intl'])->nullable()->default('standard');
            $table->string('latitude')->nullable()->default('null');
            $table->string('longitude')->nullable()->default('null');
            $table->string('place_name',180)->nullable()->default('null');
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
        Schema::dropIfExists('zipcodes');
    }
}
