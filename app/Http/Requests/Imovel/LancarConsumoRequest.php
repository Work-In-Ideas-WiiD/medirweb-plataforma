<?php

namespace App\Http\Requests\Imovel;

class LancarConsumoRequest extends ImovelRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'FAT_DTLEIFORNECEDOR' => 'required|date',
            'FAT_LEIMETRO_FORNECEDOR' => 'required|integer',
            'FAT_LEIMETRO_VALORFORNECEDOR' => 'required',
        ];
    }
}
