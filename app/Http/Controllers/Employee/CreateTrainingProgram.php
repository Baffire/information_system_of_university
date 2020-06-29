<?php
/*
 * This Controller create new training program in training_programs table
 */

namespace App\Http\Controllers\Employee;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Training_program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreateTrainingProgram extends Controller
{
    use CheckRole;

    public function createTrainingProgram(Request $request)
    {
        if ($this->checkRole()) {
            $user_id = Auth::id();

            $employee = Employee::where('user_id', $user_id)->get();

            foreach ($employee as $item) {
                $faculty_id = $item->faculty_id;
            }

            if ($request->has('training_program')) {
                $request->validate([
                    'training_program' => 'required|alpha|unique:training_programs,name|bail',
                ]);

                $training_program = new Training_program();

                $training_program->name = $request->training_program;
                $training_program->faculty_id = $faculty_id;

                $training_program->save();

                $request->session();
                $request->session()->put('message', "Образовательная программа добавлена");
                $request->session()->put('status', "success");

                return redirect()->route('employee_training_programs');
            }

            return view('employee.createTrainingProgram');

        } else {
            return redirect('/');
        }
    }
}
