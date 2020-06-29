<?php
/*Controller show titles which confirmed
 * */

namespace App\Http\Controllers\Head;

use App\Head;
use App\Http\Controllers\Controller;
use App\Title;
use Illuminate\Support\Facades\Auth;

class ShowTitlesConfirm extends Controller
{
    use CheckRole;

    public function showTitlesConfirm()
    {
        if ($this->checkRole()) {
            $user_id = Auth::id();

            $user_department_id = Head::where('user_id', $user_id)->first();

            $department_id = $user_department_id->department_id;

            $titles = Title::where(['department_id' => $department_id, 'control' => 1])->orderBy('date_control', 'desc')->paginate(10);

            return view('head.showTitlesConfirm', ['titles' => $titles]);
        } else {
            return redirect('/');
        }
    }
}
