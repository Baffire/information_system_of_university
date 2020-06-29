<?php
/* The Controller show students from students table
 * */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Student;
use Illuminate\Http\Request;

class ShowStudents extends Controller
{
    use CheckRole;

    public function showStudents(Request $request)
    {
        if ($this->checkRole()) {

            $request->session();
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
                default:
                    $order = 'asc';
                    break;
            }

            if ($sortStudents) {
                $students = Student::orderBy($sortStudents, $order)->paginate(10);
            } else {
                $students = Student::orderBy('year_of_admission', 'desc')->paginate(10);
            }

            return view('admin.showStudents', ['students' => $students]);

        } else {
            return redirect('/');
        }
    }
}
