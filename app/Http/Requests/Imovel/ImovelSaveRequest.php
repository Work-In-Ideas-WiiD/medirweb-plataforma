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
            'IMO_IDCLIENTE' => 'required|not_in:0',
            'IMO_NOME' => 'required|max:255',
            'IMO_CNPJ' => 'required|cnpj|formato_cnpj|unique:imoveis,IMO_CNPJ',
            'IMO_LOGRADOURO' => 'required',
            'IMO_COMPLEMENTO' => 'required',
            'IMO_NUMERO' => 'required',
            'IMO_BAIRRO' => 'required',
            'IMO_IDCIDADE' =>'required|not_in:0',
            'IMO_IDESTADO' =>'required|not_in:0',
            'IMO_CEP' =>'required|max:9',
            'IMO_STATUS' =>'required',
            "IMO_FATURACICLO" => 'required|integer',
            'IMO_RESPONSAVEIS' => 'required',
            'IMO_TELEFONES' => 'required',
            //'imagem' => 'required|mimes:jpeg,jpg,png|max:10000',
            'IMO_TAXAFIXA' => 'nullable|numeric',
            'IMO_IP' => 'required|ip',
            'IMO_TAXAVARIAVEL' => 'nullable|numeric',
            'foto' => 'mimes:jpeg,jpg,png,gif|max:10000',
            'capa' => 'mimes:jpeg,jpg,png,gif|max:10000',

        ];
    }
}
