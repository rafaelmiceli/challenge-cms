<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class UpdateUserRequest extends FormRequest
{
    public function rules(): array
    {
        $userId = $this->route('user');

        return [
            'name' => [
                'sometimes',
                'string',
                'max:255',
            ],

            'email' => [
                'sometimes',
                'email',
                'max:255',
                Rule::unique('users', 'email')
                    ->ignore($userId),
            ],

            'password' => [
                'sometimes',
                'nullable',
                'string',
                'min:8'
            ],
        ];
    }
}