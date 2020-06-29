<?php
/* The Controller edit one employee
 * */

namespace App\Http\Controllers\Admin;

use App\Department;
use App\Employee;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class EditEmployee extends Controller
{
    use CheckRole;

    public function editEmployee(Request $request, $id)
    {
        if ($this->checkRole()) {

            $employee = Employee::find($id);
            $user_id = $employee->user_id;
            $faculty_id = $employee->faculty_id;
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

                $employee->department_id = $request->department_id;

                $employee->save();

                return redirect('/admin/employees');
            }

            return view('admin.editEmployee', ['employee' => $employee, 'departments' => $departments]);
        } else {
            return redirect('/');
        }
    }
}
