<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use Illuminate\Support\Facades\DB;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {

            $table->id();
            $table->string('name',100);
            $table->string('iso3',3)->nullable()->default(null);
            $table->string('iso2',2)->nullable()->default(null);
            $table->string('phonecode')->nullable()->default(null);
            $table->string('capital')->nullable()->default(null);
            $table->string('currency')->nullable()->default(null);
            $table->string('currency_symbol')->nullable()->default(null);
            $table->string('tld')->nullable()->default(null);
            $table->string('native')->nullable()->default(null);
            $table->string('region')->nullable()->default(null);
            $table->string('subregion')->nullable()->default(null);
            $table->text('timezones')->nullable();
            $table->text('translations')->nullable();
            $table->decimal('latitude',10,8)->nullable()->default(null);
            $table->decimal('longitude',11,8)->nullable()->default(null);
            $table->string('emoji',191)->nullable()->default(null);
            $table->string('emojiU',191)->nullable()->default(null);
            $table->timestamp('created_at')->nullable()->default(null);
            $table->timestamp('updated_at')->nullable()->default(null);
		    $table->integer('flag')->nullable();
            $table->string('wikiDataId')->nullable()->default(null);
        });

        DB::unprepared(file_get_contents(base_path().'/database/dumps/countries.sql'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
