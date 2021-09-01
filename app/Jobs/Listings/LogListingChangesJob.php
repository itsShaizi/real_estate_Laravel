<?php

namespace App\Jobs\Listings;

use App\Models\ListingNote;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class LogListingChangesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $old_values;
    public $new_values;
    public $user_id;
    
    // CASTS
    protected $booleans = [ 
        'cashifyd',
        'lat_long_manual'
    ];

    protected $contacts = [ 
        'realtyhive_rep',
        'realtyhive_liaison',
        'real_estate_agent',
    ];

    protected $types = [ 
        'seller_type',
        'listing_type',
        'property_type',
    ];

    protected $models = [ 
        'country_id',
        'state_id'
    ];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($old_values, $new_values, $user_id = null)
    {
        $this->old_values = $old_values;

        $this->new_values = $new_values;

        $this->user_id = $user_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = array();

        foreach($this->new_values as $key => $value) {
            $data[] = [
                'field' => Str::of($key)->replaceLast('_id', '')->replace('_', ' ')->title(),
                'old_value' => $this->$key($this->old_values[$key]) ?? '-',
                'new_value' => $this->$key($value) ?? '-'
            ];
        }

        ListingNote::create([
            'listing_id' => $this->old_values['id'],
            'user_id' => $this->user_id,
            'data' => $data,
        ]);
    }

    public function additional_property_types($value)
    {
        $additional_property_types = \App\Models\AdditionalPropertyTypes::whereIn('id', explode(',', $value))->get();

        if ($additional_property_types) {
            return $additional_property_types->pluck('name')->join(', ');
        }

        return null;
    }

    public function updated_at($value)
    {
        return \Illuminate\Support\Carbon::parse($value)->toDateTimeString();
    }

    // CASTS
    public function booleanCasts($value)
    {
        return $value ? 'Yes' : 'No';
    }

    public function contactsCasts($value)
    {
        $contact = \App\Models\User::find($value);

        if ($contact) {
            return $contact->first_name . ' ' . $contact->last_name;
        }

        return null;
    }

    public function typesCasts($name, $value)
    {
        if ($value) {
            return __("global.listing.{$name}")[$value];
        }

        return null;
        
    }

    public function modelsCasts($name, $value)
    {
        $model_name = (string) Str::of($name)->replaceLast('_id', '')->replace('_', ' ')->title();

        $model_path = (string) Str::of($model_name)->prepend('\App\Models\\');

        $model = $model_path::find($value);

        if ($model) {
            return $model->name;
        }

        return null;
    }

    public function __call($name, $arguments)
    {
        if (in_array($name, $this->booleans)) {
            return $this->booleanCasts($arguments[0]);
        }

        if (in_array($name, $this->contacts)) {
            return $this->contactsCasts($arguments[0]);
        }

        if (in_array($name, $this->types)) {
            return $this->typesCasts($name, $arguments[0]);
        }

        if (in_array($name, $this->models)) {
            return $this->modelsCasts($name, $arguments[0]);
        }

        return $arguments[0] ?? null;
    }
}
