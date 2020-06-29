<?php
/*Controller create one user
 * */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CreateUser extends Controller
{
    public function createUser(Request $request)
    {
        if ($this->checkRole()) {
            $user = new User();
            $roles = Role::all();

            if ($request->has('name') && $request->has('patronymic') && $request->has('surname') && $request->has('email') && $request->has('role_id') && $request->has('password')) {

                $request->validate([
                    'name' => 'required|alpha|max:255|bail',
                    'patronymic' => 'nullable|alpha|max:255',
                    'surname' => 'required|alpha|max:255|bail',
                    'email' => 'required|email|max:255|bail',
                    'role_id' => 'required|integer|bail',
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                ]);

                $user->name = $request->name;
                $user->patronymic = $request->patronymic;
                $user->surname = $request->surname;
                $user->email = $request->email;
                $user->role_id = $request->role_id;
                $user->password = Hash::make($request->password);

                $user->save();

                return redirect('admin');
            }

            return view('admin.createUser', ['roles' => $roles]);
        } else {
            return redirect('/');
        }
    }
}
