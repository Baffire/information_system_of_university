<?php
/*
 * This Controller select all students of department from students table
 */

namespace App\Http\Controllers\Employee;

use App\Degree;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Student;
use App\Training_program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowStudents extends Controller
{
    use CheckRole;

    public function showStudents(Request $request)
    {
        if ($this->checkRole()) {
            $user_id = Auth::id();

            $employee = Employee::where('user_id', $user_id)->get();

            foreach ($employee as $item) {
                $faculty_id = $item->faculty_id;
            }

            $degrees = Degree::all();
            $training_programs = Training_program::where(['faculty_id' => $faculty_id])->get();

            if ($request->has('degree') && $request->has('training_program') && $request->has('year_of_admission')) {

                $request->validate([
                    'degree' => 'required',
                    'training_program' => 'required',
                    'year_of_admission' => 'required',
                ]);

                $degree = $request->degree;
                $training_program = $request->training_program;
                $year_of_admission = $request->year_of_admission;

                $students = Student::where(['degree_id' => $degree, 'training_program_id' => $training_program, 'year_of_admission' => $year_of_admission])->get();

                if (!empty($students[0])) {

                    $request->session();
                    $request->session()->put('students', $students);

                    return redirect('/employee/students/get');

                } else {
                    $request->session();
                    $request->session()->put('message', "Нет студентов");
                    $request->session()->put('status', "danger");

                    return redirect('/employee/students');
                }
            }

            $message = $request->session()->get('message');
            $request->session()->forget('message');

            $status = $request->session()->get('status');
            $request->session()->forget('status');

            return view('employee.showStudents', ['degrees' => $degrees, 'training_programs' => $training_programs, 'message' => $message, 'status' => $status]);

        } else {
            return redirect('/');
        }
    }
}
