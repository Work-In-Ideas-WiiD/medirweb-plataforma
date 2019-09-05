<?php

namespace App\Http\Requests\Agrupamento;

class AgrupamentoSaveRequest extends AgrupamentoRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'imovel_id' => ['required', 'exists:imoveis,id'],
            'nome' => ['required', 'between:5,300']
        ];
    }
}
