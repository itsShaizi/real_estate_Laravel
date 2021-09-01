<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListingNote extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'listing_id',
        'user_id',
        'data',
        'serial_data',
        'serial_old_data',
        'notes',
    ];

    protected $casts = [
        'data' => 'array',
    ];

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
