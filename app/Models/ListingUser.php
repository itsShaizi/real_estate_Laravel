<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListingUser extends Model
{
    use HasFactory;

    protected $table = 'listing_user';

    public function listing() {
        return $this->belongsTo(Listing::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function group() {
        return $this->belongsTo(Group::class);
    }

    public function getIsMainRealStateAgentAttribute()
    {
        return ListingUser::query()
            ->where([
                ['listing_id', $this->listing_id],
                ['group_id', 6],
            ])
            ->latest('updated_at')
            ->first()->user_id === $this->user_id;
    }
}
