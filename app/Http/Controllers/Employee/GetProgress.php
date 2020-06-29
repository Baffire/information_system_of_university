<?php
/*
 * This Controller select roadmap from roadmaps table
 */

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetProgress extends Controller
{
    use CheckRole;

    public function getProgress(Request $request)
    {
        if ($this->checkRole()) {

            $request->session();
            $students = $request->session()->get('students');
            $roadmaps = $request->session()->get('roadmaps');

            $all = count($students);

            foreach ($students as $item) {
                $year = $item->year_of_admission;
                $training_program = $item->training_program->name;
                $degree = $item->degree->name;
            }

            $message = $request->session()->get('message');
            $request->session()->forget('message');

            $status = $request->session()->get('status');
            $request->session()->forget('status');

            return view('employee.getProgress', ['all' => $all, 'students' => $students, 'roadmaps' => $roadmaps, 'training_program' => $training_program, 'year' => $year, 'degree' => $degree, 'message' => $message, 'status' => $status]);

        } else {
            return redirect('/');
        }
    }
}
