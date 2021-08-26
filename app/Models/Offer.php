<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'listing_id',
        'user_id',
        'offer_amount',
        'offer_type',
        'auction_id',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'listing_offers';

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }
}
