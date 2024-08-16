<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SitesettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'site_name' => 'required|max:255', // Only letters, spaces, and one comma allowed
            'site_logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:3072', // 3 MB = 3072 KB
            'site_banner' => 'required|image|mimes:jpeg,png,jpg,gif|max:3072', // 3 MB = 3072 KB
        ];
    }
    
    public function messages()
    {
        return [
            'site_logo.image' => 'The site logo must be an image file.',
            'site_logo.mimes' => 'The site logo must be a file of type: jpeg, png, jpg, gif.',
            'site_logo.max' => 'The site logo may not be greater than 3 MB.',
            'site_banner.image' => 'The site banner must be an image file.',
            'site_banner.mimes' => 'The site banner must be a file of type: jpeg, png, jpg, gif.',
            'site_banner.max' => 'The site banner may not be greater than 3 MB.',
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'errors' => $validator->errors(),
        ], 422)); // Unprocessable Entity status code
    }
}
