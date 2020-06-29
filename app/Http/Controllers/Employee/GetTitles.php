<?php
/*
 * This Controller select all titles of department from titles table
 */

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetTitles extends Controller
{
    use CheckRole;

    public function getTitles(Request $request)
    {
        if ($this->checkRole()) {
            $request->session();
            $titles = $request->session()->get('titles');

            foreach ($titles as $item) {
                $training_program = $item->training_program->name;
                $degree = $item->degree->name;
            }

            return view('employee.getTitles', ['titles' => $titles, 'training_program' => $training_program, 'degree' => $degree]);
        } else {
            return redirect('/');
        }
    }
}
