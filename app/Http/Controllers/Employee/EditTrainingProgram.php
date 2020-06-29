<?php
/*
 * This Controller allows edit training program in training_programs table
 */

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Training_program;
use Illuminate\Http\Request;

class EditTrainingProgram extends Controller
{
    use CheckRole;

    public function editTrainingProgram(Request $request, $id)
    {
        if ($this->checkRole()) {

            $training_program = Training_program::find($id);

            if ($request->has('name')) {
                $request->validate([
                    'name' => 'required|alpha|bail',
                ]);

                $training_program->name = $request->name;

                $training_program->save();

                $request->session();
                $request->session()->put('message', "Изменения успешно сохранены");
                $request->session()->put('status', "success");

                return redirect()->route('employee_training_programs');
            }

            return view('employee.editTrainingProgram', ['training_program' => $training_program]);

        } else {
            return redirect('/');
        }
    }
}
