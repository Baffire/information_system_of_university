<?php
/*Controller show confirm advisers from advisers table
 * */

namespace App\Http\Controllers\Head;

use App\Head;
use App\Http\Controllers\Controller;
use App\Title_confirm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowNegativeAdvisers extends Controller
{
    use CheckRole;

    public function showNegativeAdvisers(Request $request)
    {
        if ($this->checkRole()) {
            $user_id = Auth::id();

            $head = Head::where('user_id', $user_id)->first();

            $department_id = $head->department_id;

            $titles = Title_confirm::where(['department_id' => $department_id, 'confirmation' => null, 'negative' => 1])->orderBy('date_control', 'desc')->paginate(10);

            return view('head.showNegativeAdvisers', ['titles' => $titles]);
        } else {
            return redirect('/');
        }
    }
}
