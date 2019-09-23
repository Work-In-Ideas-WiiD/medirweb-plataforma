<?php

namespace App\Http\Requests\User;

class UserSaveRequest extends UserRequest
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
            'imovel_id' => 'nullable|max:255',
            'email' =>'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'roles' => 'required|max:255',
            'foto' => ['nullable', 'mimes:jpeg,jpg,png', 'max:10000']
        ];
    }
}
