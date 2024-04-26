<?php 

namespace App\Repository\Auth;
use Illuminate\Support\Facades\Auth;

use App\Repository\Interfaces\ProfileInterface;
class AuthProfile implements ProfileInterface
{

    public function profile()
    {
        $auth = Auth::user();

        return $auth;
    }
}