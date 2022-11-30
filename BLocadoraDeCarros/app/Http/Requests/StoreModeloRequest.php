<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreModeloRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nome'          => 'bail|required|max:30|unique:modelos',
            'imagem'        => 'bail|required|max:100|image|mimes:png,jpeg,jpg|max:100',
            'numero_portas' => 'bail|required|integer|digits_between:1,5',
            'lugares'       => 'bail|required|integer|digits_between:1,13',
            'air_bag'       => 'bail|required|boolean',
            'abs'           => 'bail|required|boolean',
            'marca_id'      => 'bail|required|exists:marcas,id',
        ];
    }
}
