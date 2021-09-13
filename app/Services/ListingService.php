<?php

namespace App\Services;

use App\Models\Listing;

class ListingService
{
    /**
     * Returns an amount of properties in the same area of a given Listing.
     *
     * @var string
     */
    public function getOtherProperties($listing, $amount = 20)
    {
        $sameCityProperties = Listing::whereNotNull('feed_source')->where('city', $listing->city)->where('id', '!=', $listing->id)->take($amount)->get();
        $remaining = $amount - $sameCityProperties->count();
        if($remaining > 0){
            return $sameCityProperties->merge(Listing::whereNotNull('feed_source')->where('city', '!=', $listing->city)->where('state_id',$listing->state_id)
            ->take($remaining)->get());
        }else{
            return $sameCityProperties;
        }
    }
}
