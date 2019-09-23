<?php

namespace App\Http\Requests\Unidade;

class UnidadeSaveRequest extends UnidadeRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'agrupamento_id' => ['required', 'exists:agrupamentos,id'],
            'imovel_id' => ['required', 'exists:imoveis,id'],
            'nome' => ['required', 'max:255'],
            'nome_responsavel' => ['required', 'max:255'],
            'cpf_responsavel' => ['required', 'cpf', 'formato_cpf'],
            'telefone' => ['required'],
        ];
    }
}
