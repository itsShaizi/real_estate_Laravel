<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListingUser extends Model
{
    use HasFactory;

    protected $table = 'listing_user';

    const MAIN_AGENTS = [
        'realtyhive_rep',
        'realtyhive_liaison',
        'real_estate_agent',
    ];

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * Check main agents for this listing
     *
     * @param \App\Models\Group $group [RealtyHive Rep] [RealtyHive Liaison] [Real Estate Agent]
     * @return boolean
     */
    public function isMainAgent($group)
    {
        if (in_array($group, self::MAIN_AGENTS)) {
            return Listing::find($this->listing_id)->$group === $this->user_id;
        }

        return false;
    }

    /**
     * Check if the current contact can be assigned as a Main Agent
     *
     * @param \App\Models\Group $group [RealtyHive Rep] [RealtyHive Liaison] [Real Estate Agent]
     * @return boolean
     */
    public function canBeMainAgent($group)
    {
        if (in_array($group, self::MAIN_AGENTS)) {
            return Listing::find($this->listing_id)->$group !== $this->user_id;
        }

        return false;
    }
}
