<?php

namespace App\Http\Requests\Agrupamento;

use Illuminate\Foundation\Http\FormRequest;

class AgrupamentoSaveRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'imovel_id' => ['required', 'exists:imoveis,id'],
            'nome' => ['required', 'between:5,300'],
            'repetidor_id' => ['nullable', 'integer', 'min:0'],
        ];
    }
}
