<?php
/* The Controller edit one head of department
 * */

namespace App\Http\Controllers\Admin;

use App\Department;
use App\Head;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class EditHead extends Controller
{
    use CheckRole;

    public function editHead(Request $request, $id)
    {
        if ($this->checkRole()) {

            $head = Head::find($id);
            $user_id = $head->user_id;
            $faculty_id = $head->faculty_id;
            $user = User::where('id', $user_id)->first();
            $departments = Department::where('faculty_id', $faculty_id)->get();

            if ($request->has('name') && $request->has('surname') && $request->has('email') && $request->has('department_id')) {

                $request->validate([
                    'name' => 'required|alpha|max:255|bail',
                    'patronymic' => 'nullable|alpha|max:255',
                    'surname' => 'required|alpha|max:255|bail',
                    'email' => 'required|email|max:255|bail',
                    'department_id' => 'required|integer|bail',
                ]);

                $user->name = $request->name;
                $user->patronymic = $request->patronymic;
                $user->surname = $request->surname;
                $user->email = $request->email;

                $user->save();

                $head->department_id = $request->department_id;

                $head->save();

                return redirect('/admin/heads');
            }

            return view('admin.editHead', ['head' => $head, 'departments' => $departments]);
        } else {
            return redirect('/');
        }
    }
}
