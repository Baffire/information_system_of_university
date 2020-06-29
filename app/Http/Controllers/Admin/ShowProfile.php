<?php
/*Controller show users profile
 * */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ShowProfile extends Controller
{
    use CheckRole;

    public function showProfile()
    {
        if ($this->checkRole()) {
            $user = Auth::user();

            return view('admin.showProfile', ['user' => $user]);
        } else {
            return redirect('/');
        }
    }
}
