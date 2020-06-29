<?php
/*
 * This Controller select students from students table
 */

namespace App\Http\Controllers\Head;

use App\Http\Controllers\Controller;
use App\Student;
use Illuminate\Http\Request;

class GetStudents extends Controller
{
    use CheckRole;

    public function getStudents(Request $request)
    {
        if ($this->checkRole()) {

            $request->session();
            $students = $request->session()->get('students');

            foreach ($students as $item) {
                $year = $item->year_of_admission;
                $training_program = $item->training_program->name;
                $degree = $item->degree->name;

                $training_program_id = $item->training_program_id;
                $degree_id = $item->degree_id;
            }

            $sortStudents = $request->session()->get('sortStudents');

            if ($request->sort == null && $sortStudents == null) {
                $sortStudents = null;
                $request->session()->put('sortStudents', $sortStudents);
            } elseif ($request->sort == null && !empty($sortStudents)) {
                $request->session()->put('sortStudents', $sortStudents);
            } else {
                $sortStudents = $request->sort;
                $request->session()->put('sortStudents', $sortStudents);
            }

            switch ($sortStudents) {
                case 'created_at':
                    $order = 'desc';
                    break;
                case 'year_of_admission':
                    $order = 'desc';
                    break;
                default:
                    $order = 'asc';
                    break;
            }

            if ($sortStudents) {
                $students = Student::where(['year_of_admission' => $year, 'training_program_id' => $training_program_id, 'degree_id' => $degree_id])->orderBy($sortStudents, $order)->paginate(10);
            } else {
                $students = Student::where(['year_of_admission' => $year, 'training_program_id' => $training_program_id, 'degree_id' => $degree_id])->orderBy('year_of_admission', 'desc')->paginate(10);
            }

            $message = $request->session()->get('message');
            $request->session()->forget('message');

            $status = $request->session()->get('status');
            $request->session()->forget('status');

            return view('head.getStudents', ['students' => $students, 'training_program' => $training_program, 'year' => $year, 'degree' => $degree, 'message' => $message, 'status' => $status]);

        } else {
            return redirect('/');
        }
    }
}
