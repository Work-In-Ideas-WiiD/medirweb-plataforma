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
            'cliente_id' => 'required|not_in:0',
            'nome' => 'required|max:255',
            'cnpj' => 'required|cnpj|formato_cnpj|unique:imoveis',
            'logradouro' => 'required',
            'complemento' => 'required',
            'numero' => 'required',
            'bairro' => 'required',
            'cidade_id' =>'required|not_in:0',
            'cep' =>'required|max:9',
            'status' =>'required',
            'fatura_ciclo' => 'required|integer',
            'taxa_fixa' => 'nullable|numeric',
            'ip' => 'required|ip',
            'taxa_variavel' => 'nullable|numeric',
            'foto' => 'mimes:jpeg,jpg,png,gif|max:10000',
            'capa' => 'mimes:jpeg,jpg,png,gif|max:10000',
        ];
    }
}
