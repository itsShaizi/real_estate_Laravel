<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'type' => 'required|string',
            'address' => 'required|string',
            'external_link' => 'nullable|string|url',
            'city' => 'required|string',
            'state_id' => 'required|integer',
            'country_id' => 'required|integer',
            'zip' => 'required|string',
            'license' => 'nullable|string',
            'active' => 'nullable',
            'logo' => 'nullable|string',
        ];
    }
}
