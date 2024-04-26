<?php 

namespace App\Http\Requests\Auth;
use App\Http\Requests\Request;

class UpdateProfileRequest extends Request
{

    public function fields()
    {
        return [
            "first_name",
            "last_name",
            "email",
            "address"
        ];
    }

    public function rules()
    {
        return [
            "first_name" => "required|string",
            "last_name" => "required|string",
            "email" => "required|email|unique:users,email,".auth()->user()->id,
            "address" => "nullable|array",
            "address.street" => "nullable",
            "address.city"=> "nullable",
            "address.state" => "nullable",
            "address.country" => "nullable",
            "address.pin_code" => "nullable|numeric"
        ];
    }

    public function formatData(array $data)
    {
        return $data;
    }
}