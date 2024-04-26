<?php 

namespace App\Repository\Auth;
use App\Repository\Interfaces\LoggingInterface;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserLogin implements LoggingInterface
{
    public function login(array $data)
    {
        $user = User::where('email',$data['email'])->first();
        if(!$user || !Hash::check($data['password'],$user->password)){
            return response()->json([
                'message' => 'Invalid Credentials'
            ],401);
        }
        $token = $user->createToken($user->email.'-AuthToken')->plainTextToken;
        return response()->json([
            'access_token' => $token,
        ]);
    }
}