<?php
/*
 * This Controller select roadmap from roadmaps table
 */

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetRoadmap extends Controller
{
    use CheckRole;

    public function getRoadmap(Request $request)
    {
        if ($this->checkRole()) {

            $request->session();
            $roadmaps = $request->session()->get('roadmaps');

            foreach ($roadmaps as $item) {
                $year = $item->year_of_admission;
                $training_program = $item->training_program->name;
                $degree = $item->degree->name;
            }

            $message = $request->session()->get('message');
            $request->session()->forget('message');

            $status = $request->session()->get('status');
            $request->session()->forget('status');

            return view('employee.getRoadmap', ['roadmaps' => $roadmaps, 'training_program' => $training_program, 'year' => $year, 'degree' => $degree, 'message' => $message, 'status' => $status]);

        } else {
            return redirect('/');
        }
    }
}
