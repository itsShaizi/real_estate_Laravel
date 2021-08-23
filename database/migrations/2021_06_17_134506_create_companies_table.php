<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //companies
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['mortgage_firm', 'real_estate_agency', 'title_company', 'developer', 'investment_firm', 'other', 'property_management', 'inspector', 'appraiser', 'contractor', 'construction_company', 'consulting_firm', 'bank', 'government_agency', 'law_firm', 'service_provider']);
            $table->string('address');
            $table->string('external_link')->nullable();
            $table->string('city');
            $table->unsignedBigInteger('state_id');
            $table->unsignedBigInteger('country_id');
            $table->string('zip');
            $table->string('license')->nullable();
            $table->unsignedTinyInteger('active')->default(1);
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
        Schema::dropIfExists('companies');
    }
}
