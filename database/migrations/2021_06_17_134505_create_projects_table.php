<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description', 400);
            $table->longText('content');
            $table->string('location')->nullable();
            $table->unsignedBigInteger('business_id')->nullable();
            $table->unsignedTinyInteger('number_block')->nullable();
            $table->unsignedSmallInteger('number_floor')->nullable();
            $table->unsignedSmallInteger('number_flat')->nullable();
            $table->unsignedTinyInteger('featured')->default(0);
            $table->date('date_finish')->nullable();
            $table->date('date_sell')->nullable();
            $table->decimal('price_from')->nullable();
            $table->decimal('price_to')->nullable();
            $table->enum('status', ['active', 'pending'])->default('pending');
            
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
        Schema::dropIfExists('projects');
    }
}
