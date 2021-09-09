<?php

namespace App\Actions;

use App\Models\Offer;

class CreateOfferAction 
{
    public function handle(array $data, $userId, $listingId, $auctionId = null): Offer
    {
        $exchange = app('App\Support\CurrencyExchangeRates');

        return Offer::create([
            'user_id' => $userId,
            'listing_id' => $listingId,
            'auction_id' => $auctionId,
            'offer_type' => $data['offer_type'],
            'offer_amount' => number_format($exchange->convertToUsd($data['offer_amount']), 0, '', ''),
            'currency' => $exchange->getCurrency(),
            'currency_amount' => number_format($data['offer_amount'], 0, '', ''),
            'exchange_rate' => $exchange->getRate(),
        ]);
    }
}
