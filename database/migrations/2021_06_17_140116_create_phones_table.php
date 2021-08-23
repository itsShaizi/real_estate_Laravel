<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //users companies and properties can have zero or more phones
        Schema::create('phones', function (Blueprint $table) {
            $table->id();
            $table->string('number', 25);
            $table->string('country_code', 2);
            $table->string('country_code_num', 4);
            $table->string('number_ext', 10)->nullable();
            $table->morphs('ref');
            $table->enum('phone_type', ['home','work','cell']);
            $table->unsignedTinyInteger('main')->default(0);
            $table->integer('sort_order')->nullable();
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
        Schema::dropIfExists('phones');
    }
}
