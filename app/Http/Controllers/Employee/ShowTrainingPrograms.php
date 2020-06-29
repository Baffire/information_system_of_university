<?php
/*
 * This Controller select all training programs of department from training_programs table
 */

namespace App\Http\Controllers\Employee;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Training_program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowTrainingPrograms extends Controller
{
    use CheckRole;

    public function showTrainingPrograms(Request $request)
    {
        if ($this->checkRole()) {
            $user_id = Auth::id();

            $employee = Employee::where('user_id', $user_id)->get();

            foreach ($employee as $item) {
                $faculty_id = $item->faculty_id;
            }

            $training_programs = Training_program::where('faculty_id', $faculty_id)->orderBy('id', 'desc')->get();

            $message = $request->session()->get('message');
            $request->session()->forget('message');

            $status = $request->session()->get('status');
            $request->session()->forget('status');

            return view('employee.showTrainingPrograms', ['training_programs' => $training_programs, 'message' => $message, 'status' => $status]);

        } else {
            return redirect('/');
        }
    }
}
