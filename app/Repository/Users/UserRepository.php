<?php 

namespace App\Repository\Users;

class UserRepository
{

    public function getAllPaginated()
    {
        return (new UsersRetriever())->retrievePaginated();
    }

    public function getById($id)
    {
        return (new UserFinder())->find($id);
    }

    public function create(array $data)
    {
        return (new UserCreator())->create($data);
    }

    public function update($id, array $data)
    {
        return (new UserUpdater())->update($id, $data);
    }

    public function destroy($id)
    {
        return (new UserDestroyer())->destroy($id);
    }
}