<?php
/*
 * This Controller write metadata about first login in users table
 */

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckFirstLogin extends Controller
{
    protected function checkFirstLogin(Request $request)
    {
        $user = Auth::user();

        if ($request->has('notChangePassword')) {

            $user->first_login = 0;
            $user->change_password = 0;

            $user->save();
        }

        if ($request->has('changePassword')) {

            $user->first_login = 0;
            $user->change_password = 1;

            $user->save();

            return redirect('password/reset');
        }

        return redirect()->route('teacher');
    }
}
