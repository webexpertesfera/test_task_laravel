<?php 

namespace App\Http\Requests\Auth;

use App\Http\Requests\Request;

class UserLoginRequest extends Request
{

    public function fields()
    {
        return [
            "email",
            "password"
        ];
    }

    public function rules()
    {
        return [
            "email" => "required|email|exists:users,email",
            "password" => "required"
        ];
    }

    public function formatData(array $data)
    {
        return $data;
    }
}