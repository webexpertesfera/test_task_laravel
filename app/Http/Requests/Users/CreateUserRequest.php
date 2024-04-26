<?php 

namespace App\Http\Requests\Users;
use App\Http\Requests\Request;

class CreateUserRequest extends Request
{

    public function fields()
    {
        return [
            "first_name",
            "last_name",
            "email",
            "password",
            "address"
        ];
    }

    public function rules()
    {
        return [
            "first_name" => "required|string",
            "last_name" => "nullable|string",
            "email" => "required|email",
            "password" => "required|min:6",
            "address" => "nullable|array",
            "address.street" => "nullable|string",
            "address.city" => "nullable|string",
            "address.state" => "nullable|string",
            "address.country" => "nullable|string",
            "address.pin_code" => "nullable|numeric"
        ];
    }

    public function formatData(array $data)
    {
        $data['password'] = bcrypt($data['password']);

        return $data;
    }
}