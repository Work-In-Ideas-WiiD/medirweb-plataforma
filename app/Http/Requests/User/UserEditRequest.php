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
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email'],
            'password' => ['confirmed', 'min:6', 'nullable'],
            'roles' => ['required', 'max:255'],
            'foto' => ['nullable', 'mimes:jpeg,jpg,png', 'max:10000'],
        ];
    }
}
