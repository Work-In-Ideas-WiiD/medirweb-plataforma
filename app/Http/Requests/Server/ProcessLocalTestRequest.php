<?php

namespace App\Http\Requests\Server;

use Illuminate\Foundation\Http\FormRequest;

class ProcessLocalTestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'imovel_id' => ['exists:imoveis,id', 'required'],
            'funcional_id' => ['string', 'min:1'],
            'repetidor_id' => ['integer', 'nullable'],
        ];
    }
}
