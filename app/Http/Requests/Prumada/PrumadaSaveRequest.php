<?php

namespace App\Http\Requests\Prumada;

class PrumadaSaveRequest extends PrumadaRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'imovel_id' => 'required|integer',
            'agrupamento_id' => 'required|integer',
            'unidade_id' => 'required|integer',
            'nome' => 'required|max:255',
            'funcional_id' => 'required|max:255',
            'serial' => 'required|max:255',
            'operadora' => 'required|max:255',
            'fabricante' => 'required|max:255',
            'modelo' => 'required|max:255',
            'tipo' => 'required|integer',
        ];
    }
}
