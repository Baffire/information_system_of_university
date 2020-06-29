<?php
/*
 * This Controller select all titles of department from titles table
 */

namespace App\Http\Controllers\Employee;

use App\Degree;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Title;
use App\Training_program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowTitles extends Controller
{
    use CheckRole;

    public function showTitles(Request $request)
    {
        if ($this->checkRole()) {
            $user_id = Auth::id();

            $employee = Employee::where('user_id', $user_id)->get();

            foreach ($employee as $item) {
                $faculty_id = $item->faculty_id;
            }

            $degrees = Degree::all();
            $training_programs = Training_program::where(['faculty_id' => $faculty_id])->get();

            if ($request->has('degree') && $request->has('training_program')) {

                $request->validate([
                    'degree' => 'required',
                    'training_program' => 'required',
                ]);

                $training_program = $request->training_program;
                $degree = $request->degree;

                $titles = Title::where(['training_program_id' => $training_program, 'degree_id' => $degree])->orderBy('created_at', 'desc')->paginate(10);

                if (!empty($titles[0])) {

                    $request->session();
                    $request->session()->put('titles', $titles);

                    return redirect('/employee/titles/get');

                } else {
                    $request->session();
                    $request->session()->put('message', "Нет тем");
                    $request->session()->put('status', "danger");

                    return redirect('/employee/titles');
                }
            }

            $message = $request->session()->get('message');
            $request->session()->forget('message');

            $status = $request->session()->get('status');
            $request->session()->forget('status');

            return view('employee.showTitles', ['degrees' => $degrees, 'training_programs' => $training_programs, 'message' => $message, 'status' => $status]);

        } else {
            return redirect('/');
        }
    }
}
