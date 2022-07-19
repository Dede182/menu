<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'title'=>'required|unique:posts',
            'category'=>'required|exists:categories,id',
            'description'=>'required|min:5',
            'featured_image'=>'nullable|mimes:png,jpg|file|max:512',
            'photos.*' => 'nullable|mimes:png,jpg|file|max:512',
            'photos.*' => 'nullable|mimes:png,jpg|file|max:512',
        ];
    }
}
