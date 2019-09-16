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
            'tipo' => 'required|not_in:0',
            'documento' => 'nullable',
            'nome_juridico' => 'required|max:255',
            'nome_fantasia' => 'required|max:255',
            'data_nascimento' => 'required',
            'logradouro' => 'required',
            'numero' => 'required',
            'bairro' => 'required',
            'cidade_id' =>'required|exists:cidades,id',
            'cep' =>'required|max:9',
            'status' =>'required',
            'foto' => 'nullable|mimes:jpeg,jpg,png,gif|max:10000',
        ];
    }
}
