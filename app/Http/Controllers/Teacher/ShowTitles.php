<?php
/*
 * This Controller show all titles from titles table where titles.department_id == teacher.department_id
 */
namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Teacher;
use App\Title;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowTitles extends Controller
{
    use CheckRole;
    use Notifications;

    public function showTitles(Request $request)
    {
        if ($this->checkRole()) {
            $user_id = Auth::id();

            $teacher = Teacher::where('user_id', $user_id)->get();

            foreach ($teacher as $item) {
                $department_id = $item->department_id;
            }

            $titles = Title::where(['department_id' => $department_id, 'control' => 1])->orderBy('created_at', 'desc')->paginate(10);

            $notifications = $this->notifications();

            return view('teacher.showTitles', ['titles' => $titles, 'notifications' => $notifications]);
        } else {
            return redirect('/');
        }
    }
}
