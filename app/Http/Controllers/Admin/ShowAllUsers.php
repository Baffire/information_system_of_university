<?php
/* The Controller show users in the whole system
 * */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class ShowAllUsers extends Controller
{
    use CheckRole;

    public function showAllUsers(Request $request)
    {
        if ($this->checkRole()) {

            $request->session();
            $sortUsers = $request->session()->get('sortUsers');

            if ($request->sort == null && $sortUsers == null) {
                $sortUsers = null;
                $request->session()->put('sortUsers', $sortUsers);
            } elseif ($request->sort == null && !empty($sortUsers)) {
                $request->session()->put('sortUsers', $sortUsers);
            } else {
                $sortUsers = $request->sort;
                $request->session()->put('sortUsers', $sortUsers);
            }

            switch ($sortUsers) {
                case 'created_at':
                    $order = 'desc';
                    break;
                default:
                    $order = 'asc';
                    break;
            }

            if ($sortUsers) {
                $users = User::orderBy($sortUsers, $order)->paginate(10);
            } else {
                $users = User::paginate(10);
            }

            return view('admin.showAllUsers', ['users' => $users]);
        } else {
            return redirect('/');
        }
    }
}
