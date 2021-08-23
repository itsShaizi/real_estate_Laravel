<?php

namespace Database\Factories;

use App\Models\Listing;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ListingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Listing::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'listing_title' => $this->faker->sentence(5),
            'address' => $this->faker->unique()->streetAddress(),
            'city' => 129486,//City::where('country_id,
            'state_id' => 1441,//State::where('country_id', Country::find(1))->first(),
            'country_id' => 233, //'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'zip' => $this->faker->postcode(),
            'county' => $this->faker->city(),
            'municipality' => $this->faker->city(),
            'description' => $this->faker->paragraph(),
            'directions' => $this->faker->paragraph(),
            'latitude' => 44.45532000,
            'longitude' => -90.04158000,
            'status' => $this->faker->randomElement(['bpo','watch_list','sheriff_sale','watch_list_confirmation','pre_listing','listed_active','pending_offer_still_showing','pending_offer_not_showing','pending_offer_record_only','accepted_offer','fell_thru','sold_closed','expired','hold']),
            'seller_type' => $this->faker->randomElement(['bank','rh_syndication','marketing_matters','time_limited_event','internal','rh_non_member_max','potential_upgrade','flat_fee_monthly','potential_upgrade_tle']),
            'listing_type' => $this->faker->randomElement(['traditional','auction','auction_managed','sheriff_sale']),
            'property_type' => $this->faker->randomElement(['commercial','residential','mixed_use','multi_family','land','international']),
            'lot_size' => $this->faker->numberBetween(100, 1500),
            'lot_size_unit' => $this->faker->randomElement(['acre','square_feet','square_meter','hectare']),
            'property_size' => $this->faker->numberBetween(100, 1500),
            'property_size_unit' => $this->faker->randomElement(['acre','square_feet','square_meter','hectare']),
            'showing_instructions' => $this->faker->paragraph(),
            'list_price' => $this->faker->numberBetween(100000, 50000000),
            'days_on_market' => $this->faker->numberBetween(10, 400),
            'listing_date' => $this->faker->date(),
            'year_built' => $this->faker->year(),
            'baths' => $this->faker->numberBetween(1, 5),
            'beds' => $this->faker->numberBetween(1, 5),
            'slug' => $this->faker->slug(),
            'listing_feed_id' => 1,            
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
