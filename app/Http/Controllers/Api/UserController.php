<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Repository\Users\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function getAllPaginated()
    {
        $users = $this->user->getAllPaginated();

        return UserResource::collection($users);
    }

    public function find($id)
    {
        $user = $this->user->getById($id);

        return UserResource::make($user);
    }

    public function create(CreateUserRequest $request)
    {
        $data = $request->getAndFormatData();

        $user = $this->user->create($data);

        return UserResource::make($user);
    }

    public function update($id, UpdateUserRequest $request)
    {
        $data = $request->getAndFormatData();

        $user = $this->user->update($id, $data);

        return UserResource::make($user);

    }

    public function delete($id)
    {
        $user = $this->user->destroy($id);

        return UserResource::make($user);

    }
}