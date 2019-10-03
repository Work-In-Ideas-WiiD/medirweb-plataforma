<?php

namespace App\Http\Requests\Imovel;

class ImovelEditRequest extends ImovelRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome' => ['required', 'max:255'],
            'cnpj' => ['required', 'cnpj', 'formato_cnpj'],
            'logradouro' => ['required'],
            'complemento' => ['required'],
            'numero' => ['required'],
            'bairro' => ['required'],
            'cidade_id' => ['required', 'exists:cidades,id'],
            'cep' => ['required', 'max:9'],
            'status' => ['required'],
            'taxa_fixa' => ['nullable', 'numeric'],
            'taxa_variavel' => ['nullable', 'numeric'],
            'ip' => ['required', 'ip'],
            'porta' => ['nullable', 'int', 'max:9999', 'min:0'],
            'foto' => ['mimes:jpeg,jpg,png,gif', 'max:10000'],
            'capa' => ['mimes:jpeg,jpg,png,gif', 'max:10000'],
        ];
    }
}
