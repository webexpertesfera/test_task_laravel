<?php 

namespace App\Repository\Users;

use App\Models\UserAddress;
use App\Repository\Interfaces\CreatorInterface;

class UserAddressCreator implements CreatorInterface
{

    public function create(array $data)
    {
        $create =  UserAddress::create($data);

        return $create;
    }
}