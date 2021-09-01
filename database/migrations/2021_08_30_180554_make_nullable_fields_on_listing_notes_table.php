<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MakeNullableFieldsOnListingNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('listing_notes', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable()->change();
            $table->text('serial_data')->nullable()->change();
            $table->text('serial_old_data')->nullable()->change();
            $table->string('notes', 512)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
