<?php 

namespace App\Repository\Users;

use App\Models\User;
use App\Models\UserAddress;
use App\Repository\Interfaces\DestroyerInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

class UserDestroyer implements DestroyerInterface
{
    public function destroy($id)
    {
        try{
            $user = User::findOrFail($id);

            if(UserAddress::where('user_id', $id)->exists()){
                (new AddressDestroyerThroughUser())->destroy($id);
            }

            $user->delete();
    
            return $user;
        }
        catch(ModelNotFoundException $model)
        {
            throw ValidationException::withMessages(['error' => "No user found."]);
        }
        catch(\Exception $e)
        {
            throw ValidationException::withMessages(['error' => $e->getMessage()]);
        }
        
    }
}