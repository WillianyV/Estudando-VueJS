<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLocacaoRequest extends FormRequest
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
            'data_inicio_periodo'          => 'bail|required|date_format:"d/m/Y"',
            'data_final_previsto_periodo'  => 'bail|required|date_format:"d/m/Y"',
            'data_final_realizado_periodo' => 'bail|required|date_format:"d/m/Y"',
            'valor_diaria' => 'bail|required',
            'km_inicial'   => 'bail|required|integer',
            'km_final'     => 'bail|required|integer',
            'cliente_id'   => 'bail|required|exists:clientes,id',
            'carro_id'     => 'bail|required|exists:carros,id',
        ];
    }
}
