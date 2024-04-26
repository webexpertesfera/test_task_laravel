<?php 

namespace App\Repository\Auth;

use App\Repository\Interfaces\UpdaterInterface;
use App\Models\UserAddress;
use App\Models\User;
use App\Repository\Users\UserAddressUpdater;
use App\Repository\Users\UserAddressCreator;

class AuthProfileUpdater implements UpdaterInterface
{

    public function update($id, array $data)
    {
        $address = [];

        if(isset($data['address']))
        {
            $address  = $data['address'];
        }
            unset($data['address']);

        $update = User::find($id);

        $checkAddressExists = UserAddress::where('user_id', $id)->exists();

        if($checkAddressExists)
        {
            (new UserAddressUpdater())->update($id, $address);
        }else if(!empty($address)){
            $address['user_id'] = $id;
            (new UserAddressCreator())->create($address);
        }

        $update->update($data);

        return $update;
    }
}