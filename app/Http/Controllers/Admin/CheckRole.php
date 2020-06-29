<?php
namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Support\Facades\Auth;

trait CheckRole
{
    protected function checkRole()     //Check permission. The role Admin is 1.
    {
        $user_id = Auth::id();
        $user = User::find($user_id);
        $id_role = $user->role_id;

        if ($id_role == 1) {
            return true;
        } else {
            return false;
        }
    }
}


