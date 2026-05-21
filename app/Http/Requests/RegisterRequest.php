<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
      
            return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        
        ];
    }
    #[Override]
    public function messages()
    {
         return [
        'name.required' => 'Name is required',
        'name.string' => 'Name must be a string',
        'name.max' => 'Name is too long',

        'email.required' => 'Email is required',
        'email.email' => 'Invalid email format',
        'email.unique' => 'Email already exists',

        'password.required' => 'Password is required',
        'password.min' => 'Password must be at least 6 characters',
    ];
    }
}
