<?php

namespace App\Http\Requests\Cliente;

class ClienteEditRequest extends ClienteRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'CLI_TIPO' => 'required|not_in:0',
            'cnpj' => 'nullable|cnpj|formato_cnpj|unique:clientes,CLI_ID,' .$this->get('id'). ',CLI_ID',
            'cpf' => 'nullable|cpf|formato_cpf|unique:clientes,CLI_ID,' .$this->get('id'). ',CLI_ID',
            'CLI_NOMEJUR' => 'required|max:255',
            'CLI_NOMEFAN' => 'required|max:255',
            'CLI_DATANASC' => 'required',
            'CLI_LOGRADOURO' => 'required',
            'CLI_NUMERO' => 'required',
            'CLI_BAIRRO' => 'required',
            'CLI_CIDADE' =>'required|not_in:0',
            'CLI_ESTADO' =>'required|not_in:0',
            'CLI_CEP' =>'required|max:9',
            'CLI_STATUS' =>'required',
            'CLI_DADOSBANCARIOS' => 'required',
            'CLI_DADOSCONTATO' => 'required',
            //'imagem' => 'required|mimes:jpeg,jpg,png|max:10000',
            'foto' => 'mimes:jpeg,jpg,png,gif|max:10000',

        ];
    }
}
