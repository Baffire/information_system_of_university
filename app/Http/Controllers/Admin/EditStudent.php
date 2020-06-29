<?php
/* The Controller edit one student
 * */

namespace App\Http\Controllers\Admin;

use App\Degree;
use App\Department;
use App\Http\Controllers\Controller;
use App\Student;
use App\Training_program;
use App\User;
use Illuminate\Http\Request;

class EditStudent extends Controller
{
    use CheckRole;

    public function editStudent(Request $request, $id)
    {
        if ($this->checkRole()) {

            $student = Student::find($id);
            $user_id = $student->user_id;
            $faculty_id = $student->faculty_id;
            $user = User::where('id', $user_id)->first();
            $departments = Department::where('faculty_id', $faculty_id)->get();
            $training_programs = Training_program::where('faculty_id', $faculty_id)->get();
            $degrees = Degree::all();

            if ($request->has('name') && $request->has('surname') && $request->has('department_id') && $request->has('group_id') && $request->has('training_program_id') && $request->has('degree_id') && $request->has('year_of_admission')) {

                $request->validate([
                    'name' => 'required|alpha|max:255|bail',
                    'patronymic' => 'nullable|alpha|max:255',
                    'surname' => 'required|alpha|max:255|bail',
                    'department_id' => 'required|integer|bail',
                    'training_program_id' => 'required|integer|bail',
                    'degree_id' => 'required|integer|bail',
                    'year_of_admission' => 'required|integer|bail',
                ]);

                $user->name = $request->name;
                $user->patronymic = $request->patronymic;
                $user->surname = $request->surname;

                $user->save();

                $student->department_id = $request->department_id;
                $student->training_program_id = $request->training_program_id;
                $student->degree_id = $request->degree_id;
                $student->year_of_admission = $request->year_of_admission;

                $student->save();

                return redirect('/admin/students');
            }

            return view('admin.editStudent', ['student' => $student, 'departments' => $departments, 'training_programs' => $training_programs, 'degrees' => $degrees]);
        } else {
            return redirect('/');
        }
    }
}
