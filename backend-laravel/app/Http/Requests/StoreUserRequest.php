<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiBaseRequest as FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize()
    {
        // You can add authorization logic here if needed
        return true;
    }

    public function rules()
    {
        return [
            'full_name' => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'roles'     => 'required|array',
            'roles.*'   => 'exists:roles,id', // Validate that each role exists
        ];
    }

    public function messages()
    {
        return [
            'full_name.required' => 'The full name is required.',
            'email.required'     => 'The email address is required.',
            'email.unique'       => 'The email address has already been taken.',
            'roles.required'     => 'At least one role is required.',
            'roles.array'        => 'The roles must be an array.',
            'roles.*.exists'     => 'One or more selected roles do not exist.',
        ];
    }
}
