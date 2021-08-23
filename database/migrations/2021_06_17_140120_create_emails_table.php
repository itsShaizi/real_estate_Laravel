<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //a company an agent and a user can have many emails
        Schema::create('emails', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->morphs('ref');
            $table->enum('email_type', ['primary', 'home','work']);
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
        Schema::dropIfExists('emails');
    }
}
