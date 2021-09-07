<?php

namespace App\Models;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;
use App\Jobs\Listings\LogListingChangesJob;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [ 'listing_title', 'address', 'city', 'state_id', 'country_id', 'zip', 'county', 'municipality', 'description', 'directions', 'latitude', 'longitude', 'lat_long_manual', 'status', 'seller_type', 'listing_type', 'property_type', 'additional_property_types', 'lockbox_type', 'closing_status', 'featured', 'lot_size', 'lot_size_unit', 'property_size', 'property_size_unit', 'property_types', 'showing_instructions', 'list_price', 'list_price_disclaimer', 'sale_price', 'commission_percent', 'days_on_market', 'parcel_number', 'listing_date', 'listing_expiration_date', 'close_acceptance_date', 'close_date', 'close_posession_date', 'year_built', 'baths', 'beds', 'half_baths', 'units', 'lot_number', 'buyer_fee', 'sale_number', 'purchase_price', 'slug', 'location_md5', 'auctioneer_license', 'starting_bid', 'starting_bid_disclaimer', 'reserve_price', 'opening_bid', 'min_bid_increment', 'terms_and_conditions', 'local_economy', 'due_diligence', 'realtor_license', 'ad_description', 'virtual_tour_link', 'seo_keywords', 'seo_title', 'seo_description', 'cashifyd', 'feed_id', 'listing_feed_id', 'feed_source', 'feed_lead_routing_email', 'feed_disclaimer', 'feed_mod_timestamp', 'external_link', 'mls_name', 'provider_name', 'provider_state', 'listing_source', 'listhub', 'listhub_listing_key', 'project_id', 'realtyhive_rep', 'realtyhive_liaison', 'real_estate_agent'];

    //for Accessor attributes
    protected $appends = ['image_link', 'country_name', 'state_name', 'formatted_price'];

    protected $casts = [
        'cashifyd' => 'boolean',
        'lat_long_manual' => 'boolean',
        'additional_property_types' => 'json',
        'listing_date' => 'date',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::updated(function ($listing) {
            LogListingChangesJob::dispatch(
                $listing->getOriginal(),
                $listing->getChanges(),
                auth()->id() ?? null
            );
        });
    }

    public function country() {
        return $this->belongsTo(Country::class);
    }

    public function state() {
        return $this->belongsTo(State::class);
    }

 	public function images() {
 		return $this->morphMany(Image::class, 'ref');
 	}

 	public function videos() {
 		return $this->morphMany(Video::class, 'ref');
 	}

 	public function users() {
		return $this->belongsToMany(User::class);
        //return $this->hasManyThrough(User::class, ListingUser::class);
        //return $this->belongsToMany(ListingUser::class);
 	}

    public function contacts() {
        return $this->belongsToMany(User::class)
            ->withPivot('group_id')
            ->withTimestamps();
    }

    public function notes() {
        return $this->hasMany(ListingNote::class)->latest();
    }

    public function sources() {
        return $this->hasMany(ListingSource::class);
    }

    public function offers() {
        return $this->hasMany(Offer::class, 'listing_id');
    }

    public function auction()
    {
        return $this->belongsToMany(Auction::class,'listing_auction');
    }

    /**
     *
     *Accessors
     *
     */
    public function getImageLinkAttribute() {
        $image = $this->images()->first();
        if($image) {
            return url('/') . '/storage/listings/images/' . $this->id . '/thumb/' .$image->title;
        } else {
            return '/images/resources/no-image-yellow.jpg';
        }
    }

    public function getCountryNameAttribute() {
        return $this->country->name;
    }

    public function getStateNameAttribute() {
        return $this->state->name;
    }

    public function getFormattedPriceAttribute() {
        $unit = isset($this->list_price_unit) ? strtoupper($this->list_price_unit) : 'USD';
        return number_format($this->list_price) . ' ' . $unit;
    }


    /**
     * Get the name of the index associated with the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        if(env('APP_ENV') === 'production') {
            return 'listings';
        } else {
            return 'rh-rewrite';
            //return 'listings-dev';
        }
    }
    public function toSearchableArray()
    {
        //$array = $this->toArray();
        $array = array();
        // Customize the data array...
        $array['id'] = $this->id;
        $array['state'] = $this->state_name;
        $array['state_code'] = $this->state->iso2;
        $array['country'] = $this->country_name;
        $array['country_code'] = $this->country->iso2;
        $array['title'] = isset($this->listing_title) ? $this->listing_title : $this->address;
        $array['sub_title'] = isset($this->city) ? $this->city : '';
        $array['sub_title'] .= isset($this->county) ? ', '.$this->county : '';
        $array['sub_title'] .= isset($this->municipality) ? ', '.$this->municipality : '';
        $array['sub_title'] .= isset($array['state_code']) ? ', '.$array['state_code'] : '';
        $array['sub_title'] .= isset($this->zip) ? ', '.$this->zip : '';
        $array['sub_title'] .= isset($array['country_code']) ? ', '.$array['country_code'] : '';
        $array['beds'] = !empty($this->beds) ? $this->beds : null;
        $array['baths'] = !empty($this->baths) ? $this->baths : null;
        $array['lot_size'] = isset($this->lot_size) ? $this->lot_size : null;
        $array['lot_size_unit'] = isset($this->lot_size_unit) ? $this->lot_size_unit : '';
        $array['property_size'] = isset($this->property_size) ? $this->property_size : null;
        $array['property_size_unit'] = isset($this->property_size_unit) ? $this->property_size_unit : '';
        $array['list_price_formatted'] = number_format($this->list_price);
        $array['list_price_unit'] = isset($this->list_price_unit) ? strtoupper($this->list_price_unit) : 'USD';
        $array['list_price'] = $this->list_price;
        $array['listing_type'] = $this->listing_type;
        $array['property_type'] = $this->property_type;
        $array['provider_name'] = $this->provider_name;
        $array['slug'] = $this->slug;
        if($this->listing_type == 'auction') {
            if(!empty($this->auction->all())) { 
                $array['acution_start'] = $this->auction->all()[0]->start_date .' '.$this->auction->all()[0]->start_time;
                $array['acution_end'] = $this->$this->auction->all()[0]->end_date .' '.$this->auction->all()[0]->end_time;
            }
        }
        $array['_geoloc']['lat'] = $this->latitude;
        $array['_geoloc']['lng'] = $this->longitude;

        //there are no images at this point in the importing process... 2DO: resolve that
        $array['image_link'] = $this->image_link;

        return $array;
    }

    /**
     * Determine if the model should be searchable.
     *
     * @return bool
     */
    public function shouldBeSearchable()
    {
        return $this->isActive();
    }

    public function isActive() {
        if($this->status === 'listed_active') return TRUE;
        else return FALSE;
    }

}

