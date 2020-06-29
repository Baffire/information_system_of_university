<?php
/*
 * This Controller show titles from titles table where titles.teacher_id == teachers.id
 */

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Teacher;
use App\Title;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShowMyTitles extends Controller
{
    use CheckRole;
    use Notifications;

    public function showMyTitles(Request $request)
    {
        if ($this->checkRole()) {

            $user_id = Auth::id();

            $teacher = Teacher::where('user_id', $user_id)->get();

            foreach ($teacher as $item) {
                $teacher_id = $item->id;
            }

            $titles = Title::where(['teacher_id' => $teacher_id])->orderBy('created_at', 'desc')->paginate(10);

            $message = $request->session()->get('message');
            $request->session()->forget('message');

            $status = $request->session()->get('status');
            $request->session()->forget('status');

            $notifications = $this->notifications();

            return view('teacher.showMyTitles', ['titles' => $titles, 'notifications' => $notifications, 'message' => $message, 'status' => $status]);
        } else {
            return redirect('/');
        }
    }
}
