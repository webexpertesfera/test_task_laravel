<?php 

namespace App\Repository\Users;

use App\Models\User;
use App\Models\UserAddress;
use App\Repository\Interfaces\UpdaterInterface;

class UserUpdater implements UpdaterInterface
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
            (new UserAddressCreator())->create($address);
        }

        $update->update($data);

        return $update;
    }

}