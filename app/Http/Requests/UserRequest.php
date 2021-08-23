<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $rules = [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email|unique:users',
            'role_id' => 'required|integer',
            'primary_company' => 'nullable|integer',
            'active' => 'nullable|integer',
            'is_contact' => 'nullable|integer',
            'password' => ['required', 'confirmed', Password::min(8)]
        ];


        if (in_array($this->method(), ['PUT', 'PATCH'])) {
            // the password must be validated in the controller
            $rules['password'] = 'nullable';

            $rules['email'] = [
                'required',
                'email',
                Rule::unique('users')->ignore($this->id)
            ];
        }

        return $rules;
    }
}
