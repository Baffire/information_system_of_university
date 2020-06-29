<?php
/* The Controller show teachers from teachers table
 * */

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Teacher;
use Illuminate\Http\Request;

class ShowTeachers extends Controller
{
    use CheckRole;

    public function showTeachers(Request $request)
    {
        if ($this->checkRole()) {

            $request->session();
            $sortTeachers = $request->session()->get('sortTeachers');

            if ($request->sort == null && $sortTeachers == null) {
                $sortTeachers = null;
                $request->session()->put('sortTeachers', $sortTeachers);
            } elseif ($request->sort == null && !empty($sortTeachers)) {
                $request->session()->put('sortTeachers', $sortTeachers);
            } else {
                $sortTeachers = $request->sort;
                $request->session()->put('sortTeachers', $sortTeachers);
            }

            switch ($sortTeachers) {
                case 'created_at':
                    $order = 'desc';
                    break;
                default:
                    $order = 'asc';
                    break;
            }

            if ($sortTeachers) {
                $teachers = Teacher::orderBy($sortTeachers, $order)->paginate(10);
            } else {
                $teachers = Teacher::paginate(10);
            }

            return view('admin.showTeachers', ['teachers' => $teachers]);
        } else {
            return redirect('/');
        }
    }
}
