<?php 

namespace App\Repository\Users;

use App\Models\UserAddress;
use App\Repository\Interfaces\DestroyerInterface;

class AddressDestroyerThroughUser implements DestroyerInterface
{
    public function destroy($id)
    {
        $address = UserAddress::where('user_id', $id);

        $address->delete();

        return $address;
    }
}