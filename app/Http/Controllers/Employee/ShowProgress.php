<?php
/*
 * This Controller select students
 */

namespace App\Http\Controllers\Employee;

use App\Degree_of_preparation;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Roadmap;
use App\Student;
use App\Training_program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowProgress extends Controller
{
    use CheckRole;

    public function showProgress(Request $request)
    {
        if ($this->checkRole()) {
            $user_id = Auth::id();

            $employee = Employee::where('user_id', $user_id)->get();

            foreach ($employee as $item) {
                $faculty_id = $item->faculty_id;
            }

            $training_programs = Training_program::where(['faculty_id' => $faculty_id])->get();

            if ($request->has('training_program') && $request->has('year_of_admission')) {

                $request->validate([
                    'training_program' => 'required|filled',
                    'year_of_admission' => 'required|filled',
                ]);

                $training_program = $request->training_program;
                $year_of_admission = $request->year_of_admission;

                $students = Student::where(['training_program_id' => $training_program, 'year_of_admission' => $year_of_admission])->get();
                $roadmaps = Roadmap::where(['training_program_id' => $training_program, 'year_of_admission' => $year_of_admission])->get();

                if (count($roadmaps) != 0) {
                    foreach ($roadmaps as $roadmap) {
                        $roadmap_id = $roadmap->id;
                    }

                    $degrees = Degree_of_preparation::where(['roadmap_id' => $roadmap_id])->get();

                    if (!empty($students[0]) && !empty($roadmaps[0])) {
                        $request->session();
                        $request->session()->put('students', $students);
                        $request->session()->put('roadmaps', $roadmaps);
                        $request->session()->put('degrees', $degrees);

                        return redirect('/employee/progress/get');
                    } else {
                        $request->session();
                        $request->session()->put('message', "Студенты не найдены");
                        $request->session()->put('status', "danger");

                        return redirect('/employee/progress');
                    }

                } else {
                    $request->session();
                    $request->session()->put('message', "Дорожная карта не найдена");
                    $request->session()->put('status', "danger");

                    return redirect('/employee/progress');
                }
            }


            $message = $request->session()->get('message');
            $request->session()->forget('message');

            $status = $request->session()->get('status');
            $request->session()->forget('status');

            return view('employee.showProgress', ['training_programs' => $training_programs, 'message' => $message, 'status' => $status]);

        } else {
            return redirect('/');
        }
    }
}
