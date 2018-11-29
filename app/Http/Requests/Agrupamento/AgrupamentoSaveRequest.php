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
            'AGR_IDIMOVEL' => 'required|not_in:0',
            'AGR_NOME' => 'required',
            'AGR_TAXAFIXA' => 'nullable|numeric',
            'AGR_TAXAVARIAVEL' => 'nullable|numeric',
        ];
    }
}
