<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeedListing extends Model
{
    use HasFactory;

     protected $fillable = ['feed_id', 'mls_name', 'mls_number', 'mls_id', 'provider_name', 'listing_feed_id', 'raw_data', 'md5'];
}
