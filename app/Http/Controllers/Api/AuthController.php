<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdateProfileRequest;
use App\Http\Requests\Auth\UserLoginRequest;
use App\Http\Requests\Auth\UserRegisterRequest;
use App\Repository\Auth\AuthRepository;
use App\Repository\Users\UserRepository;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public $user;
    public $accessorUser;

    public function __construct(AuthRepository $user, UserRepository $accessorUser)
    {
        $this->user = $user;

        $this->accessorUser = $accessorUser;
    }

    public function register(UserRegisterRequest $request)
    {
        $data = $request->getAndFormatData();

        $user = $this->user->register($data);

        return UserResource::make($user);
    }

    public function login(UserLoginRequest $request)
    {
        $data = $request->getAndFormatData();

        $user = $this->user->login($data);

        return response()->json(["data" => $user]);
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $data = $request->getAndFormatData();

        $user = $this->user->updateProfile(Auth::id(), $data);

        return UserResource::make($user);

    }

    public function profile()
    {
        $loggedUser = $this->user->profile();

        return response()->json(["data" => $loggedUser]);
    }

    public function deleteProfile()
    {
        $loggedUserId = Auth::user()->id;

        $user = $this->accessorUser->destroy($loggedUserId);

        return UserResource::make($user);
    }
}