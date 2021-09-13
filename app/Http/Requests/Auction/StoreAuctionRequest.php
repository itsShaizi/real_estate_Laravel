<?php

namespace App\Http\Requests\Auction;

use Illuminate\Foundation\Http\FormRequest;

class StoreAuctionRequest extends FormRequest
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
            'name' => 'required|string',
            'featured' => 'nullable|integer',
            'start_date' => 'required|string|date',
            'start_time' => 'required|string|date_format:"H:i"',
            'end_date' => 'required|string|date',
            'end_time' => 'required|string|date_format:"H:i"',
            'description' => 'required|string',
        ];
    }
}
