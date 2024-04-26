<?php

namespace App\Repository\Users;

use App\Models\UserAddress;
use App\Repository\Interfaces\UpdaterInterface;

class UserAddressUpdater implements UpdaterInterface
{

    public function update($userId, array $data)
    {
        $address = UserAddress::where('user_id', $userId);

        $address->update($data);

        return $address;
    }
}