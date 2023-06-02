<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class AdminRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
            ],
            'email' => [
                'required',
                'email',
                // 'unique:users',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                Password::default()
            ],
            'phone' => [
                'required',
                'integer',
                'min:10',
            ],
            'position_id' => [
                'required',
            ],
            'dob' => [
                'required'
            ],
            'gender' => [
                'required'
            ],
        ];
    }
}
