<?php
/* The Controller edit one user
 * */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class EditUser extends Controller
{
    use CheckRole;

    public function editUser(Request $request, $id)
    {
        if ($this->checkRole()) {

            $user = User::find($id);
            $roles = Role::all();

            if ($request->has('name') && $request->has('surname') && $request->has('email') && $request->has('role_id')) {

                $request->validate([
                    'name' => 'required|alpha|max:255|bail',
                    'patronymic' => 'nullable|alpha|max:255',
                    'surname' => 'required|alpha|max:255|bail',
                    'email' => 'required|email|max:255|bail',
                    'role_id' => 'required|integer|bail',
                ]);

                $user->name = $request->name;
                $user->patronymic = $request->patronymic;
                $user->surname = $request->surname;
                $user->email = $request->email;
                $user->role_id = $request->role_id;

                $user->save();

                return redirect('/admin/users');
            }

            return view('admin.editUser', ['user' => $user, 'roles' => $roles]);
        } else {
            return redirect('/');
        }
    }
}
