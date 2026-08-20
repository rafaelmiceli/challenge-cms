<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticuloRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'titulo' => [
                'required',
                'string',
                'max:255',
            ],

            'contenido' => [
                'nullable',
                'string',
            ],

            'precio' => [
                'required',
                'numeric',
                'min:0',
            ],

            'stock' => [
                'required',
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