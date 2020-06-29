<?php
/*
 * This Controller select all teachers of department from teachers table
 */

namespace App\Http\Controllers\Employee;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Teacher;
use Illuminate\Support\Facades\Auth;

class ShowTeachers extends Controller
{
    use CheckRole;

    public function showTeachers()
    {
        if ($this->checkRole()) {
            $user_id = Auth::id();

            $employee = Employee::where('user_id', $user_id)->get();

            foreach ($employee as $item) {
                $department_id = $item->department_id;
            }

            $teachers = Teacher::where('department_id', $department_id)->paginate(10);

            return view('employee.showTeachers', ['teachers' => $teachers]);
        } else {
            return redirect('/');
        }
    }
}
