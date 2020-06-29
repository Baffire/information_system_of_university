<?php
namespace App\Http\Controllers\Teacher;

use App\User;
use Illuminate\Support\Facades\Auth;

trait CheckRole
{
    protected function checkRole()     //Check permission. The role Teacher is 3.
    {
        $user_id = Auth::id();
        $user = User::find($user_id);
        $id_role = $user->role_id;

        if($id_role == 3){
            return true;
        } else {
            return false;
        }
    }
}


