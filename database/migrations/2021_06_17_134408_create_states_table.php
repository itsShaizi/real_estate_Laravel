<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\DB;


class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {

            $table->id();
    		$table->string('name');
            $table->foreignId('country_id')->constrained('countries')->onDelete('cascade');
	    	$table->char('country_code',2);
		    $table->string('fips_code')->nullable()->default(null);
    		$table->string('iso2')->nullable()->default(null);
    		$table->decimal('latitude',10,8)->nullable()->default(null);
    		$table->decimal('longitude',11,8)->nullable()->default(null);
            $table->timestamp('created_at')->nullable()->default(null);
    		$table->timestamp('updated_at')->nullable()->default(null);
            $table->tinyInteger('flag')->nullable()->default(null);
    		$table->string('wikiDataId')->nullable()->default(null);

        }); 

        DB::unprepared(file_get_contents(base_path().'/database/dumps/states.sql'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('states');
    }
}
