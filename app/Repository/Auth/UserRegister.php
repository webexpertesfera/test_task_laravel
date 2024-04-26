<?php 

namespace App\Repository\Auth;

use App\Models\User;
use App\Models\UserAddress;
use App\Repository\Interfaces\CreatorInterface;
use App\Repository\Users\UserAddressCreator;
class UserRegister implements CreatorInterface
{

    public function create(array $data)
    {
       
        $address = [];

        if(isset($data['address']))
        {
            $address = $data['address'];
        }
        unset($data['address']);

        $create = User::create($data);

        if(!empty($address))
        {
            $address['user_id'] = $create->id;
            (new UserAddressCreator())->create($address);
        }

        return $create;
    }
}