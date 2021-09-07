<?php

namespace App\Http\Requests\Projects;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:191'
            ],
            'description' => [
                'required',
                'string',
                'max:4000'
            ],
            'content' => [
                'required',
                'string',
                'max:5000'
            ],
            'location' => [
                'nullable',
                'string',
                'max:191'
            ],
            'business_id' => [
                'nullable',
                'integer'
            ],
            'number_block' => [
                'nullable',
                'integer',
                'max:100'
            ],
            'number_floor' => [
                'nullable',
                'integer',
                'max:99999'
            ],
            'number_flat' => [
                'nullable',
                'integer',
                'max:99999'
            ],
            'featured' => [
                'nullable',
                'integer',
                'max:100'
            ],
            'date_finish' => [
                'nullable',
                'date',
            ],
            'date_sell' => [
                'nullable',
                'date',
            ],
            'price_from' => [
                'nullable',
                'numeric',
                'max:999999'
            ],
            'price_to' => [
                'nullable',
                'numeric',
                'max:99999999'
            ],
            
        ];
    }
}
