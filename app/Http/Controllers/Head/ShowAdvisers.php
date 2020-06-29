<?php
/*Controller show advisers from advisers table
 * */

namespace App\Http\Controllers\Head;

use App\Head;
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

            $head = Head::where('user_id', $user_id)->first();

            $department_id = $head->department_id;

            $titles = Title_confirm::where(['department_id' => $department_id, 'confirmation' => null, 'negative' => null])->orderBy('created_at', 'desc')->paginate(10);

            $message = $request->session()->get('message');
            $request->session()->forget('message');

            $status = $request->session()->get('status');
            $request->session()->forget('status');

            return view('head.showAdvisers', ['titles' => $titles, 'message' => $message, 'status' => $status]);
        } else {
            return redirect('/');
        }
    }
}
