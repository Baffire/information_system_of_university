<?php
/* The Controller show employees from employees table
 * */

namespace App\Http\Controllers\Admin;

use App\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShowEmployees extends Controller
{
    use CheckRole;

    public function showEmployees(Request $request)
    {
        if ($this->checkRole()) {

            $request->session();
            $sortEmployees = $request->session()->get('sortEmployees');

            if ($request->sort == null && $sortEmployees == null) {
                $sortEmployees = null;
                $request->session()->put('sortEmployees', $sortEmployees);
            } elseif ($request->sort == null && !empty($sortEmployees)) {
                $request->session()->put('sortEmployees', $sortEmployees);
            } else {
                $sortEmployees = $request->sort;
                $request->session()->put('sortEmployees', $sortEmployees);
            }

            switch ($sortEmployees) {
                case 'created_at':
                    $order = 'desc';
                    break;
                default:
                    $order = 'asc';
                    break;
            }

            if ($sortEmployees) {
                $employees = Employee::orderBy($sortEmployees, $order)->paginate(10);
            } else {
                $employees = Employee::paginate(10);
            }

            return view('admin.showEmployees', ['employees' => $employees]);
        } else {
            return redirect('/');
        }
    }
}
