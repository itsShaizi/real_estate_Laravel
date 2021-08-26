<?php

use Illuminate\Support\Facades\Schema;
use App\Models\AdditionalPropertyTypes;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdditionalPropertyTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additional_property_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        collect($this->data())->each(function ($type) {
            AdditionalPropertyTypes::create($type);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('additional_property_types');
    }

    /**
     * Initial data for table additional_property_types
     *
     * @return array
     */
    private function data(): array
    {
        return [
            ['name' => 'Agricultural'],
            ['name' => 'Apartment'],
            ['name' => 'Bar/Lounge'],
            ['name' => 'Boat Slip'],
            ['name' => 'Boat Slips'],
            ['name' => 'Bowling Alley'],
            ['name' => 'Business'],
            ['name' => 'C-Store/Gas Station'],
            ['name' => 'Car Wash'],
            ['name' => 'Commercial'],
            ['name' => 'Condo'],
            ['name' => 'Development'],
            ['name' => 'Duplex'],
            ['name' => 'Equestrian'],
            ['name' => 'Farm'],
            ['name' => 'Fourplex'],
            ['name' => 'Golf Course'],
            ['name' => 'Healthcare'],
            ['name' => 'Home'],
            ['name' => 'Hospitality'],
            ['name' => 'Industrial'],
            ['name' => 'International'],
            ['name' => 'Investment'],
            ['name' => 'Land'],
            ['name' => 'Luxury'],
            ['name' => 'Manufactured'],
            ['name' => 'Manufactured Home'],
            ['name' => 'Marina'],
            ['name' => 'Mixed Use'],
            ['name' => 'Mobile Home'],
            ['name' => 'Multi-Family'],
            ['name' => 'Office'],
            ['name' => 'Other'],
            ['name' => 'Real Estate Only'],
            ['name' => 'Recreation'],
            ['name' => 'Residential'],
            ['name' => 'Restaurant'],
            ['name' => 'Retail'],
            ['name' => 'Single Family'],
            ['name' => 'Special Purpose'],
            ['name' => 'Storage'],
            ['name' => 'Townhome'],
            ['name' => 'Townhouse'],
            ['name' => 'Triplex'],
            ['name' => 'Turn-key'],
            ['name' => 'Villa'],
            ['name' => 'Warehouse'],
            ['name' => 'Warehousing'],
            ['name' => 'Waterfront'],
        ];
    }
}
