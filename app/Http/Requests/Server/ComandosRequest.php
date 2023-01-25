<?php

namespace App\Http\Requests\Server;

use Illuminate\Foundation\Http\FormRequest;

class ComandosRequest extends FormRequest
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
            'imovel_id' => ['required', 'exists:imoveis,id'],
            'repetidor_id' => ['required', 'int', 'min:0'],
            'comando' => ['required', 'string'],
            'pulsos' => ['nullable', 'int', 'min:0', 'max:255']
        ];
    }
}
