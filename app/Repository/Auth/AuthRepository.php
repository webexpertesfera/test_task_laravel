<?php 

namespace App\Repository\Auth;

class AuthRepository
{

    public function profile()
    {
        return (new AuthProfile())->profile();
    }

    public function updateProfile($id, array $data)
    {
        return (new AuthProfileUpdater())->update($id, $data);
    }

    public function register(array $data)
    {
        return (new UserRegister())->create($data);
    }

    public function login(array $data)
    {
        return (new UserLogin())->login($data);
    }
}