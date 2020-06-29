<?php
namespace App\Http\Controllers\Employee;

use App\User;
use Illuminate\Support\Facades\Auth;

trait CheckRole
{
    protected function checkRole()     //Check permission. The role Teacher is 3.
    {
        $user_id = Auth::id();
        $user = User::find($user_id);
        $id_role = $user->role_id;

        if($id_role == 4){
            return true;
        } else {
            return false;
        }
    }
}


