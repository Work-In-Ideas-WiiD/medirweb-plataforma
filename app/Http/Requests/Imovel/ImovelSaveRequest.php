<?php

namespace App\Http\Requests\Imovel;

class ImovelSaveRequest extends ImovelRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'cliente_id' => ['required', 'exists:clientes,id'],
            'nome' => ['required', 'max:255'],
            'cnpj' => ['required', 'cnpj', 'formato_cnpj', 'unique:imoveis'],
            'logradouro' => ['required'],
            'complemento' => ['required'],
            'numero' => ['required'],
            'bairro' => ['required'],
            'cidade_id' => ['required', 'exists:cidades,id'],
            'cep' => ['required', 'max:9'],
            'status' => ['required'],
            'fatura_ciclo' => ['required', 'integer'],
            'taxa_fixa' => ['nullable', 'numeric'],
            'ip' => ['required', 'ip'],
            'porta' => ['nullable', 'int', 'max:9999', 'min:0'],
            'taxa_variavel' => ['nullable', 'numeric'],
            'foto' => ['mimes:jpeg,jpg,png,gif', 'max:10000'],
            'capa' => ['mimes:jpeg,jpg,png,gif', 'max:10000'],
        ];
    }
}
