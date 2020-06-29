<?php
/*Controller show confirm advisers from advisers table
 * */

namespace App\Http\Controllers\Head;

use App\Head;
use App\Http\Controllers\Controller;
use App\Title_confirm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowConfirmAdvisers extends Controller
{
    use CheckRole;

    public function showConfirmAdvisers(Request $request)
    {
        if ($this->checkRole()) {
            $user_id = Auth::id();

            $head = Head::where('user_id', $user_id)->first();

            $department_id = $head->department_id;

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

            return view('head.showConfirmAdvisers', ['titles' => $titles, 'message' => $message, 'status' => $status]);
        } else {
            return redirect('/');
        }
    }
}
