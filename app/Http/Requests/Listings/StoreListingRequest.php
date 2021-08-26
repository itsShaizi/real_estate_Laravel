<?php

namespace App\Http\Requests\Listings;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class StoreListingRequest extends FormRequest
{
    /**
     * Indicates if the validator should stop on the first rule failure.
     *
     * @var bool
     */
    protected $stopOnFirstFailure = true;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'slug' => Str::slug($this->address . ' ' . $this->city . ' ' . $this->zip),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'seller_type' => [
                'nullable',
                'string',
            ],
            'cashifyd' => [
                'nullable',
                'boolean'
            ],
            'realtyhive_rep' => [
                'nullable',
                'integer',
                'exists:users,id'
            ],
            'realtyhive_liaison' => [
                'nullable',
                'integer',
                'exists:users,id'
            ],
            'real_estate_agent' => [
                'nullable',
                'integer',
                'exists:users,id'
            ],
            'listing_type' => [
                'required',
                'string'
            ],
            'property_type' => [
                'required',
                'string'
            ],
            'additional_property_types' => [
                'required',
                'string'
            ],
            'listing_title' => [
                'nullable',
                'string',
                'max:256'
            ],
            'address' => [
                'nullable',
                'string',
                'max:191'
            ],
            'slug' => [
                'nullable',
                'string',
                'max:512'
            ],
            'country_id' => [
                'required',
                'integer',
                'exists:states,id'
            ],
            'state_id' => [
                'required',
                'integer',
                'exists:states,id'
            ],
            'city' => [
                'required',
                'string',
                'max:150'
            ],
            'zip' => [
                'required',
                'string',
                'max:20'
            ],
            'county' => [
                'nullable',
                'string',
                'max:150'
            ],
            'municipality' => [
                'nullable',
                'string',
                'max:150'
            ],
            'lat_long_manual' => [
                'nullable',
                'string',
            ],
            'latitude' => [
                'nullable',
                'numeric',
            ],
            'longitude' => [
                'nullable',
                'numeric',
            ],
            'parcel_number' => [
                'nullable',
                'string',
                'max:191'
            ],
            'year_built' => [
                'nullable',
                'date_format:Y'
            ],
            'lot_size' => [ 
                'nullable',
                'numeric',
                'max:99999999999999999999'
            ],
            'units' => [ 
                'nullable',
                'integer',
                'max:99999'
            ],
            'beds' => [ 
                'nullable',
                'integer',
                'max:99999'
            ],
            'half_baths' => [ 
                'nullable',
                'integer',
                'max:99999'
            ],
            'description' => [
                'required',
                'string',
                'max:5000'
            ],
            'directions' => [
                'nullable',
                'string',
                'max:5000'
            ],
            'terms_and_conditions' => [
                'nullable',
                'string',
                'max:5000'
            ],
            'local_economy' => [
                'nullable',
                'string',
                'max:5000'
            ],
            'ad_description' => [
                'nullable',
                'string',
                'max:128'
            ],
            'list_price' => [
                'required',
                'numeric',
            ],
            'reserve_price' => [
                'nullable',
                'numeric',
            ],
            'opening_bid' => [
                'nullable',
                'numeric',
            ],
            'min_bid_increment' => [
                'nullable',
                'numeric',
            ],
            'listing_date' => [
                'nullable',
                'date',
            ],
            'listing_expiration_date' => [
                'nullable',
                'date',
            ],
            'days_on_market' => [ 
                'nullable',
                'integer',
                'max:99999'
            ],
            'commission_percent' => [
                'nullable',
                'integer',
                'max:100'
            ],
            'lot_number' => [
                'nullable',
                'string',
                'max:64'
            ],
            'buyer_fee' => [
                'nullable',
                'numeric',
            ],
            'sale_number' => [
                'nullable',
                'string',
                'max:64'
            ],
            'purchase_price' => [
                'nullable',
                'numeric',
            ],
            'close_date' => [
                'nullable',
                'date',
            ],
            'close_acceptance_date' => [
                'nullable',
                'date',
            ],
            'development_terms' => [
                'required',
                'string',
                'max:5000'
            ],
        ];
    }
}
