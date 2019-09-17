<?php

namespace App\Http\Requests\Unidade;

class UnidadeEditRequest extends UnidadeRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => 'required|max:255',
            'nome_responsavel' => 'required|max:255',
            'cpf_responsavel' => 'required|cpf|formato_cpf',
            'telefone' => 'required',
        ];
    }
}
