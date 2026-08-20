<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticuloRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titulo' => [
                'sometimes',
                'string',
                'max:255',
            ],

            'contenido' => [
                'nullable',
                'string',
            ],

            'precio' => [
                'sometimes',
                'numeric',
                'min:0',
            ],

            'stock' => [
                'sometimes',
                'integer',
                'min:0',
            ],

            'activo' => [
                'sometimes',
                'boolean',
            ],
        ];
    }
}