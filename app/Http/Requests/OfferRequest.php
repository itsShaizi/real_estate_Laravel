<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
{
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'listing_id' => 'required',
            'user_id' => 'required',
            'offer_amount' => 'required',
            'offer_type' => 'required',
            'auction_id' => 'nullable',
        ];
    }

    /**
     * Check if the Offer Belongs to the Logged In User.
     *
     */
    public function ensureTheOfferBelongsToTheLoggedUser()
    {
        if($this->user_id != auth()->user()->id){
            abort(404);
        }

        return;
    }
}
