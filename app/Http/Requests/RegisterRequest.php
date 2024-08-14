<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'fullname' => 'required|string|max:255|regex:/^[a-zA-Z\s,]*$/', // Only letters, spaces, and one comma allowed
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[A-Z])(?=(?:[^0-9]*[0-9]){3})(?=.*[a-z])(?=.*[\W_])[^\s]*$/', // At least 3 numbers, 1 uppercase, 3 lowercase, 1 special character, no spaces
            ]
        ];
    }

    public function messages()
    {
        return [
            'fullname.required' => 'Full name is required.',
            'fullname.regex' => 'Full name must only contain letters, spaces, and at most one comma.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please provide a valid email address.',
            'email.unique' => 'This email is already taken.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least 8 characters long.',
            'password.confirmed' => 'Password confirmation does not match.',
            'password.regex' => 'Password must contain at least 3 numbers, 1 uppercase letter, 3 lowercase letters, 1 special character, and no spaces.',
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
