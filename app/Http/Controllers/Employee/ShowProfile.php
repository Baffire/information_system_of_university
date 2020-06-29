<?php
/*
 * This Controller show profile information
 */

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ShowProfile extends Controller
{
    use CheckRole;

    public function showProfile()
    {
        if ($this->checkRole()) {
            $user = Auth::user();

            return view('employee.showProfile', ['user' => $user]);
        } else {
            return redirect('/');
        }
    }
}
