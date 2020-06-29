<?php
/*
 * This Controller select all confirm title of department from students table
 */

namespace App\Http\Controllers\Head;

use App\Head;
use App\Http\Controllers\Controller;
use App\Title;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowTitles extends Controller
{
    use CheckRole;

    public function showTitles(Request $request)
    {
        if ($this->checkRole()) {
            $user = Auth::user();
            $user_id = Auth::id();

            $user_department_id = Head::where('user_id', $user_id)->first();

            $department_id = $user_department_id->department_id;

            $titles = Title::where(['department_id' => $department_id, 'control' => null, 'negative' => null])->orderBy('created_at', 'desc')->paginate(5);

            if ($request->has('choose')) {

                $title = Title::find($request->choose);

                $title->control = 1;

                $title->save();

                return redirect('head/titles');
            }

            $message = $request->session()->get('message');
            $request->session()->forget('message');

            $status = $request->session()->get('status');
            $request->session()->forget('status');

            return view('head.showTitles', ['titles' => $titles, 'message' => $message, 'status' => $status]);
        } else {
            return redirect('/');
        }
    }
}
