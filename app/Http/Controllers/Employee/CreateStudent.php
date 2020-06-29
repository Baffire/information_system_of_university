<?php
/*
 * This Controller create one new student in students and users tables
 */

namespace App\Http\Controllers\Employee;

use App\Degree;
use App\Degree_of_preparation;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Roadmap;
use App\Student;
use App\Training_program;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CreateStudent extends Controller
{
    use CheckRole;

    public function createStudent(Request $request)
    {
        if ($this->checkRole()) {
            $user_id = Auth::id();

            $employee = Employee::where('user_id', $user_id)->get();

            foreach ($employee as $item) {
                $department_id = $item->department_id;
                $faculty_id = $item->faculty_id;
            }

            $training_programs = Training_program::where('faculty_id', $faculty_id)->get();
            $degrees = Degree::all();

            if ($request->has('name') && $request->has('surname') && $request->has('email') && $request->has('password') && $request->has('password_confirmation') && $request->has('training_program') && $request->has('degree') && $request->has('year_of_admission')) {

                $request->validate([
                    'name' => 'required|alpha|max:255|bail',
                    'patronymic' => 'nullable|alpha|max:255',
                    'surname' => 'required|alpha|max:255|bail',
                    'email' => 'required|email|unique:users,email|bail',
                    'password' => 'required|string|min:8|confirmed',
                    'training_program' => 'required|integer|bail',
                    'degree' => 'required|integer|bail',
                    'year_of_admission' => 'required|integer|bail',
                ]);

                $name = $request->name;
                $patronymic = $request->patronymic;
                $surname = $request->surname;
                $email = $request->email;
                $password = $request->password;
                $training_program = $request->training_program;
                $degree = $request->degree;
                $year_of_admission = $request->year_of_admission;

                $user = new User();

                $user->name = $name;
                $user->patronymic = $patronymic;
                $user->surname = $surname;
                $user->email = $email;
                $user->role_id = 2;
                $user->password = Hash::make($password);

                $user->save();

                $last_user = User::orderBy('id', 'desc')->first();

                $student = new Student();

                $student->user_id = $last_user->id;
                $student->faculty_id = $faculty_id;
                $student->department_id = $department_id;
                $student->training_program_id = $training_program;
                $student->degree_id = $degree;
                $student->year_of_admission = $year_of_admission;
                $student->role_id = 2;

                $student->save();

                $control_types = Roadmap::where(['training_program_id' => $training_program, 'year_of_admission' => $year_of_admission])->get();
                $last_student = Student::orderBy('id', 'desc')->first();

                if (!empty($control_types)) {
                    foreach ($control_types as $control_type) {
                        $degree_of_preparation = new Degree_of_preparation();

                        $degree_of_preparation->student_id = $last_student->id;
                        $degree_of_preparation->roadmap_id = $control_type->id;

                        $degree_of_preparation->save();
                    }
                }

                $request->session();
                $request->session()->put('message', "Пользователь успешно создан");

                return redirect('/employee/student/create');
            }

            $message = $request->session()->get('message');
            $request->session()->forget('message');

            return view('employee.createStudent', ['training_programs' => $training_programs, 'degrees' => $degrees, 'message' => $message]);
        } else {
            return redirect('/');
        }
    }
}
