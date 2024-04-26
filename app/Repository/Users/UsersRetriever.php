<?php 

namespace App\Repository\Users;

use App\Models\User;
use App\Repository\Retriever;

class UsersRetriever extends Retriever
{

    public function query()
    {
        $query = User::orderBy('id', 'desc');

        return $query;
    }
}