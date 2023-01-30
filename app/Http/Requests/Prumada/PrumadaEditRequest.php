<?php

namespace App\Http\Requests\Prumada;

class PrumadaEditRequest extends PrumadaRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'funcional_id' => 'required|max:255',
            'nome' => 'required|max:255',
            'serial' => 'required|max:255',
            'operadora' => 'required|max:255',
            'fabricante' => 'required|max:255',
            'modelo' => 'required|max:255',
            'tipo' => 'required|integer',
        ];
    }
}
