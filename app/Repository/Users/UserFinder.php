<?php 

namespace App\Repository\Users;

use App\Models\User;
use App\Repository\Interfaces\FinderInterface;

class UserFinder implements FinderInterface
{
    public function find($id)
    {
        $find = User::find($id);

        return $find;
    }
}