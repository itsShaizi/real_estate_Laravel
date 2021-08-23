<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\DB;


class CreateFeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feeds', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('status', ['active', 'deactivated', 'deleted']);
            $table->enum('type', ['data_only', 'syndication']);
            $table->string('feed_class');
            $table->timestamps();
            $table->softDeletes();
        });

        // Insert some stuff
        DB::table('feeds')->insert(
            array(
                'name' => 'ListHub',
                'status' => 'active',
                'type' => 'syndication',
                'feed_class' => 'App\Feeds\Listhub',
                'created_at' => now(),
            )
        );
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('feeds');
    }
}
