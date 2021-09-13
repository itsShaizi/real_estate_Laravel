<?php

namespace Database\Factories;

use App\Models\Auction;
use App\Models\Listing;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OfferFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Offer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'listing_id' => Listing::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'auction_id' => null,
            'offer_amount' => $this->faker->randomNumber(5, true),
            'offer_type' => 'traditional',
            'outcome' => null,
            'details' => null,
        ];
    }
}
