<?php

namespace App\Http\Requests\Timeline;

class TimelineSaveRequest extends TimelineRequest
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
            'TIMELINE_IDPRUMADA' => 'required|integer',
            'TIMELINE_DESCRICAO' => 'required',
        ];
    }
}
