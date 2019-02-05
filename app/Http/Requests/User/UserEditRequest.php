<?php

namespace App\Http\Requests\User;

class UserEditRequest extends UserRequest
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
            'USER_IMOID' => 'required|max:255',
            'email' => 'required|email|unique:users,id,' .$this->get('id'),
            'password' => 'confirmed',
            'roles' => 'required|max:255',
        ];
    }
}
