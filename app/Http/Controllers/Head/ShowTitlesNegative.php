<?php
/*Controller show titles which negative estimated
 * */

namespace App\Http\Controllers\Head;

use App\Head;
use App\Http\Controllers\Controller;
use App\Title;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowTitlesNegative extends Controller
{
    use CheckRole;

    public function showTitlesNegative(Request $request)
    {
        if ($this->checkRole()) {
            $user_id = Auth::id();

            $user_department_id = Head::where('user_id', $user_id)->first();

            $department_id = $user_department_id->department_id;

            $titles = Title::where(['department_id' => $department_id, 'negative' => 1])->orderBy('updated_at', 'desc')->paginate(10);

            return view('head.showTitlesNegative', ['titles' => $titles]);
        } else {
            return redirect('/');
        }
    }
}
