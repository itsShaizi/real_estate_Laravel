<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
            'title' => 'required|string',
            'content' => 'required|string',
            'tags' => 'nullable',
            'blog_cover_photo' => 'required',
            'category' => 'required',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'title.required' => 'Post title is required',
            'content.required' => 'Post content is required',
            'blog_cover_photo.required' => 'Post need to have a cover photo',
            'category.required' => 'Category is required'
        ];
    }
}
