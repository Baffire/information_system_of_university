<?php

namespace App\Http\Controllers\Student;

use App\User;
use Illuminate\Support\Facades\Auth;

trait CheckRole
{
    protected function checkRole()     //Check permission. The role Student is 2.
    {
        $user_id = Auth::id();
        $user = User::find($user_id);
        $id_role = $user->role_id;

        if($id_role == 2){
            return true;
        } else {
            return false;
        }
    }
}


