<?php
/*
 * This Controller select all advisers of department from title_confirms table
 */

namespace App\Http\Controllers\Employee;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Title_confirm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowAdvisers extends Controller
{
    use CheckRole;

    public function showAdvisers(Request $request)
    {
        if ($this->checkRole()) {
            $user_id = Auth::id();

            $employee = Employee::where('user_id', $user_id)->get();

            foreach ($employee as $item) {
                $department_id = $item->department_id;
            }

            $titles = Title_confirm::where(['department_id' => $department_id, 'confirmation' => 1, 'negative' => null, 'estimate' => null])->orderBy('created_at', 'desc')->paginate(10);

            $sortTitles = $request->session()->get('sortTitles');

            if ($request->sort == null && $sortTitles == null) {
                $sortTitles = null;
                $request->session()->put('sortTitles', $sortTitles);
            } elseif ($request->sort == null && !empty($sortTitles)) {
                $request->session()->put('sortTitles', $sortTitles);
            } else {
                $sortTitles = $request->sort;
                $request->session()->put('sortTitles', $sortTitles);
            }

            switch ($sortTitles) {
                case 'created_at':
                    $order = 'desc';
                    break;
                case 'order':
                    $order = 'desc';
                    break;
                case 'estimate':
                    $order = 'desc';
                    break;
                default:
                    $order = 'asc';
                    break;
            }

            if ($sortTitles) {
                $titles = Title_confirm::where(['department_id' => $department_id, 'confirmation' => 1, 'negative' => null, 'estimate' => null])->orderBy($sortTitles, $order)->paginate(10);
            } else {
                $titles = Title_confirm::where(['department_id' => $department_id, 'confirmation' => 1, 'negative' => null, 'estimate' => null])->orderBy('date_control', 'desc')->paginate(10);
            }

            $message = $request->session()->get('message');
            $request->session()->forget('message');

            $status = $request->session()->get('status');
            $request->session()->forget('status');

            return view('employee.showAdvisers', ['message' => $message, 'status' => $status, 'titles' => $titles]);
        } else {
            return redirect('/');
        }
    }
}
