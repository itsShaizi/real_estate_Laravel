<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    use HasFactory;

	protected $fillable = ['name', 'start_date', 'start_time', 'end_date', 'end_time', 'description'];

    public function listings()
    {
        return $this->belongsToMany(Listing::class,'listing_auction');
    }

}
