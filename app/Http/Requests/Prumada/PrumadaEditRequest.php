<?php

namespace App\Http\Requests\Prumada;

class PrumadaEditRequest extends PrumadaRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'PRU_IDIMOVEL' => 'required|integer',
            'PRU_IDAGRUPAMENTO' => 'required|integer',
            'PRU_IDUNIDADE' => 'required|integer',
            'PRU_IDFUNCIONAL' => 'required|max:255',
            'PRU_SERIAL' => 'required|max:255',
            'PRU_OPERADORA' => 'required|max:255',
            'PRU_FABRICANTE' => 'required|max:255',
            'PRU_MODELO' => 'required|max:255',

        ];
    }
}
