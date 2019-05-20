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
            'UNI_NOME' => 'required|max:255',
            'UNI_RESPONSAVEL' => 'required|max:255',
            'UNI_CPFRESPONSAVEL' => 'required|cpf|formato_cpf',
            'UNI_TELRESPONSAVEL' => 'required',
        ];
    }
}
