<?php

namespace App\Http\Requests\Unidade;

class UnidadeUserSaveRequest extends UnidadeRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'email' =>'required|email|unique:users',
        ];
    }
}
