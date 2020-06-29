<?php
/*Controller show all teachers from head.department_id
 * */

namespace App\Http\Controllers\Head;

use App\Head;
use App\Http\Controllers\Controller;
use App\Teacher;
use Illuminate\Support\Facades\Auth;

class ShowTeachers extends Controller
{
    use CheckRole;

    public function showTeachers()
    {
        if ($this->checkRole()) {
            $user_id = Auth::id();

            $user_department_id = Head::where('user_id', $user_id)->first();

            $department_id = $user_department_id->department_id;

            $teachers = Teacher::where(['department_id' => $department_id])->paginate(10);

            return view('head.showTeachers', ['teachers' => $teachers]);
        } else {
            return redirect('/');
        }
    }
}
