<?php

namespace App\Http\Requests;

use App\Enums\EstadoArticulo;
use Illuminate\Validation\Rules\Enum;
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

            'fecha_publicacion' => [
                'required',
                'date',
                'date_format:Y-m-d'
            ],

            'estado' => [
                'required',
                new Enum(EstadoArticulo::class)
            ]
        ];
    }
}