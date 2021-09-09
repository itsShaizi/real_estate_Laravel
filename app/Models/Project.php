<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'content', 'location', 'business_id', 'number_block', 'number_floor', 'number_flat', 'featured', 'date_finish', 'date_sell', 'price_from', 'price_to', 'status'];

    public function images() {
        return $this->morphMany(Image::class, 'ref');
    }

    public function videos() {
        return $this->morphMany(Video::class, 'ref');
    }

    public function listings()
    {
        return $this->hasMany(Listing::class);
    }

    public function companies() {
        return $this->belongsTo(Company::class, 'business_id');
    }

    public function projectListingCount($project_id) {   
      return ListingProject::where('project_id', $project_id)->count();
    }

    public function getFormattedPriceAttribute($price) {
        return number_format($price) . ' USD';
    }

    public function projectListingMinPrice($project_id) {   
        $listings = ListingProject::where('project_id', $project_id)->get('listing_id')->toArray();
        $listings = Arr::flatten($listings);
        $list_min_price = Listing::whereIn('id', $listings)->min('list_price'); 
        return number_format($list_min_price) . ' USD';  
      
    }

    public function projectListingMaxPrice($project_id) {   
       $listings = ListingProject::where('project_id', $project_id)->get('listing_id')->toArray();
       $listings = Arr::flatten($listings);
       $list_max_price = Listing::whereIn('id', $listings)->max('list_price');
       return number_format($list_max_price) . ' USD';
    }
    
}
