<?php
/* The Controller create one employee
 * */

namespace App\Http\Controllers\Admin;

use App\Department;
use App\Employee;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CreateEmployee extends Controller
{
    use CheckRole;

    public function createEmployee(Request $request)
    {
        if ($this->checkRole()) {

            $departments = Department::all();

            if ($request->has('name') && $request->has('surname') && $request->has('email') && $request->has('department_id') && $request->has('password')) {

                $request->validate([
                    'name' => 'required|alpha|max:255|bail',
                    'patronymic' => 'nullable|alpha|max:255',
                    'surname' => 'required|alpha|max:255|bail',
                    'email' => 'required|email|max:255|bail',
                    'department_id' => 'required|integer|bail',
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                ]);

                $user = new User();

                $user->name = $request->name;
                $user->patronymic = $request->patronymic;
                $user->surname = $request->surname;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->role_id = 4;

                $user->save();

                $last_user = User::orderBy('id', 'desc')->first();
                $department = Department::where('id', $request->department_id)->first();
                $faculty_id = $department->faculty_id;

                $employee = new Employee();

                $employee->user_id = $last_user->id;
                $employee->faculty_id = $faculty_id;
                $employee->department_id = $request->department_id;
                $employee->role_id = 4;

                $employee->save();

                return redirect('/admin/employees');
            }

            return view('admin.createEmployee', ['departments' => $departments]);
        } else {
            return redirect('/');
        }
    }
}
